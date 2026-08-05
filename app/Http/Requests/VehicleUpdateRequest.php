<?php

namespace App\Http\Requests;

use App\Models\Enums\BodyStyle;
use App\Models\Enums\FuelType;
use App\Models\Enums\Transmission;
use App\Models\Enums\VehicleColor;
use App\Models\Enums\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'trim' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'mileage' => ['required', 'integer', 'min:0'],
            'vehicle_type' => ['required', Rule::enum(VehicleType::class)],
            'body_style' => ['required', Rule::enum(BodyStyle::class)],
            'exterior_color' => ['required', Rule::enum(VehicleColor::class)],
            'interior_color' => ['required', Rule::enum(VehicleColor::class)],
            'transmission' => ['nullable', Rule::enum(Transmission::class)],
            'fuel_type' => ['nullable', Rule::enum(FuelType::class)],
            'price' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'has_clean_title' => ['required', 'boolean'],
            'money_still_owed' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deleted_images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }
}
