<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index()
    {
        $featuredVehicles = Vehicle::where('is_featured', true)->take(3)->get();
        $latestVehicles = Vehicle::where('is_featured', false)->orderBy('year', 'desc')->take(3)->get();
        $allVehicles = Vehicle::all();

        $recentlySoldVehicles = Vehicle::whereHas('orders', function ($query) {
            $query->where('orders.status', \App\Models\Enums\OrderStatus::DELIVERED);
        })->take(3)->get();

        $brands = Vehicle::select('make')->distinct()->pluck('make');
        $categories = Vehicle::select('vehicle_type')->distinct()->pluck('vehicle_type');
        $fuelTypes = Vehicle::select('fuel_type')->whereNotNull('fuel_type')->distinct()->pluck('fuel_type');
        $transmissions = Vehicle::select('transmission')->whereNotNull('transmission')->distinct()->pluck('transmission');
        $testimonials = Testimonial::with('user')
            ->where('is_approved', true)
            ->latest()
            ->get();

        return view('welcome', compact(
            'featuredVehicles',
            'latestVehicles',
            'recentlySoldVehicles',
            'allVehicles',
            'brands',
            'categories',
            'fuelTypes',
            'transmissions',
            'testimonials'
        ));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $request->user()->testimonials()->create($validated);

        return redirect()->to(route('home') . '#testimonials')
            ->with('success', __('public/home.testimonial_success'));
    }

    public function filter(Request $request)
    {
        $query = Vehicle::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('make', 'LIKE', "%{$search}%")
                    ->orWhere('model', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('brand')) {
            $query->where('make', $request->get('brand'));
        }

        if ($request->filled('category')) {
            $query->where('vehicle_type', $request->get('category'));
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->get('fuel_type'));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->get('transmission'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'year_desc' => $query->orderBy('year', 'desc'),
            'mileage_asc' => $query->orderBy('mileage', 'asc'),
            default => $query->latest(),
        };

        $vehicles = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('vehicles.partials.list', compact('vehicles'))->render(),
                'count' => $vehicles->count(),
            ]);
        }

        return redirect()->route('home');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $vehicles = Vehicle::where('title', 'LIKE', "%{$query}%")
            ->orWhere('make', 'LIKE', "%{$query}%")
            ->orWhere('model', 'LIKE', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($vehicle) {
                $imageUrl = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400';

                if (is_array($vehicle->images) && count($vehicle->images) > 0) {
                    $imageUrl = $vehicle->images[0];
                }

                return [
                    'id' => $vehicle->id,
                    'title' => $vehicle->make . ' ' . $vehicle->model,
                    'year' => $vehicle->year,
                    'price' => $vehicle->price,
                    'image' => $imageUrl,
                ];
            });

        return response()->json($vehicles);
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year_min' => ['nullable', 'integer', 'min:1900'],
            'year_max' => ['nullable', 'integer', 'min:1900'],
            'max_budget' => ['nullable', 'integer', 'min:0'],
            'desired_mileage' => ['nullable', 'integer', 'min:0'],
            'body_style' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'zip_code' => ['required', 'string', 'max:20'],
        ]);

        VehicleRequest::create($request->all());

        return redirect()->back()->with('success', 'Your custom vehicle request has been submitted successfully. Our team will be in touch soon.');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['required', 'string'],
        ]);

        DB::table('contacts')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
