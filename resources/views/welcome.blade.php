<x-guest-layout>

    <!-- HERO BANNER MINIMALISTE -->
    <div class="bg-slate-950 py-20 px-4 border-b border-slate-800">
        <div class="max-w-4xl mx-auto flex flex-col items-center text-center">

            <!-- Petit badge élégant à la place du logo -->
            <span class="inline-flex items-center px-3 py-1 rounded-full text-md font-semibold bg-amber-500/10 text-amber-500 border border-amber-500/20 mb-6">
                405 AUTO GROUP LLC
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-4">
                {{ __('public/home.hero_title') }}
            </h1>

            <p class="text-base md:text-xl text-gray-400 max-w-2xl leading-relaxed">
                {{ __('public/home.hero_subtitle') }}
            </p>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-0 pb-8">

        <!-- TITRE DE SECTION + BADGE STOCK -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 mt-12 gap-4" id="catalog">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">{{ __('public/home.live_inventory') }}</span>
                </div>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">{{ __('public/home.complete_collection') }}</h3>
            </div>
            <p class="text-gray-500 text-sm font-medium bg-gray-100 px-4 py-2 rounded-full w-max">
                {{ __('public/home.showing') }} <span id="vehicle-count" class="font-bold text-gray-900">{{ $allVehicles->count() }}</span> {{ __('public/home.available_vehicles') }}
            </p>
        </div>

        <!-- BARRE DE FILTRES STYLE DEALERSHIP US -->
        <div class="bg-white p-6 rounded-3xl border border-gray-200/80 shadow-xl shadow-gray-100/50 mb-12">
            <form id="filter-form" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Search -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.search_keywords') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="filter-search" placeholder="{{ __('public/home.search_placeholder') }}"
                                class="w-full text-xs font-medium pl-10 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                        </div>
                    </div>

                    <!-- Make / Brand -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.make') }}</label>
                        <select name="brand" class="w-full text-xs font-medium py-3 px-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                            <option value="">{{ __('public/home.all_makes') }}</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.vehicle_type') }}</label>
                        <select name="category" class="w-full text-xs font-medium py-3 px-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                            <option value="">{{ __('public/home.all_vehicle_types') }}</option>
                            @foreach($categories as $category)
                            @php
                            $categoryValue = is_object($category) ? $category->value : $category;
                            $categoryLabel = is_object($category) && method_exists($category, 'label') ? $category->label() : $categoryValue;
                            @endphp
                            <option value="{{ $categoryValue }}">{{ $categoryLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.sort_by') }}</label>
                        <select name="sort" class="w-full text-xs font-medium py-3 px-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                            <option value="latest">{{ __('public/home.sort_latest') }}</option>
                            <option value="price_asc">{{ __('public/home.sort_price_asc') }}</option>
                            <option value="price_desc">{{ __('public/home.sort_price_desc') }}</option>
                            <option value="year_desc">{{ __('public/home.sort_year_desc') }}</option>
                            <option value="mileage_asc">{{ __('public/home.sort_mileage_asc') }}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-gray-100 items-end">
                    <!-- Fuel Type -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.fuel_type') }}</label>
                        <select name="fuel_type" class="w-full text-xs font-medium py-3 px-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                            <option value="">{{ __('public/home.all_fuel_types') }}</option>
                            @foreach($fuelTypes as $fuel)
                            @php
                            $fuelValue = is_object($fuel) ? $fuel->value : $fuel;
                            $fuelLabel = is_object($fuel) && method_exists($fuel, 'label') ? $fuel->label() : ucfirst($fuelValue);
                            @endphp
                            <option value="{{ $fuelValue }}">{{ $fuelLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transmission -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-1.5">{{ __('public/home.transmission') }}</label>
                        <select name="transmission" class="w-full text-xs font-medium py-3 px-3 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-slate-900 focus:ring-slate-900 transition">
                            <option value="">{{ __('public/home.all_transmissions') }}</option>
                            @foreach($transmissions as $trans)
                            @php
                            $transValue = is_object($trans) ? $trans->value : $trans;
                            $transLabel = is_object($trans) && method_exists($trans, 'label') ? $trans->label() : ucfirst($transValue);
                            @endphp
                            <option value="{{ $transValue }}">{{ $transLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <div>
                        <button type="button" id="reset-filters" class="w-full py-3 px-4 text-xs font-bold uppercase tracking-wider text-gray-600 bg-gray-100 hover:bg-slate-900 hover:text-white rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            {{ __('public/home.reset_filters') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- GRILLE DE VÉHICULES -->
        <div id="vehicles-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-20 relative min-h-[200px]">
            @include('vehicles.partials.list', ['vehicles' => $allVehicles])
        </div>

        <!-- SECTION HISTORIQUE DES VENTES & LIVRAISONS -->
        @if(isset($recentlySoldVehicles) && $recentlySoldVehicles->isNotEmpty())
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4 border-t border-gray-100 pt-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 mb-1 block">{{ __('public/home.proven_track_record') }}</span>
                <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ __('public/home.recently_sold') }}</h3>
            </div>
            <a href="#catalog" class="inline-flex items-center text-xs font-bold uppercase tracking-wider px-5 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-amber-500 transition shadow-md gap-2">
                <span>{{ __('public/home.browse_available') }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            @foreach($recentlySoldVehicles as $vehicle)
            @php
            $statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus
            ? $vehicle->status
            : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);
            $locationLabel = $vehicle->location instanceof \App\Models\Enums\VehicleLocation
            ? $vehicle->location->label()
            : (\App\Models\Enums\VehicleLocation::tryFrom($vehicle->location)?->label() ?? __('enums.location.usa_warehouse'));
            @endphp
            <div class="bg-white rounded-3xl border border-gray-200/80 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="relative h-52 bg-gray-100 overflow-hidden">
                    <img src="{{ !empty($vehicle->images) ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $vehicle->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                    <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                        <span class="bg-red-600 text-white text-[10px] uppercase font-extrabold px-2.5 py-1 rounded-md shadow-md tracking-wider">
                            {{ __('enums.status.sold_delivered') }}
                        </span>
                    </div>

                    <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end z-10 text-white">
                        <span class="text-2xl font-black tracking-tight">${{ number_format($vehicle->price) }}</span>
                    </div>
                </div>

                <div class="p-5">
                    <h4 class="font-bold text-gray-900 text-lg mb-1 line-clamp-1">{{ $vehicle->title }}</h4>

                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-500 mb-4">
                        <span>{{ $vehicle->year }}</span>
                        <span>•</span>
                        <span>{{ number_format($vehicle->mileage) }} {{ __('public/home.unit_miles') }}</span>
                        <span>•</span>
                        <span class="text-slate-700 font-bold">{{ $locationLabel }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-100">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}"
                            class="py-2.5 px-3 border border-gray-200 text-center text-gray-700 font-bold text-xs rounded-xl hover:bg-gray-50 transition">
                            {{ __('public/home.view_details') }}
                        </a>
                        <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id, 'action' => 'order_similar']) }}"
                            class="py-2.5 px-3 bg-amber-500 text-white text-center font-bold text-xs rounded-xl hover:bg-amber-600 transition shadow-sm">
                            {{ __('public/home.reserve_similar') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- TÉMOIGNAGES CLIENTS -->
        <section id="testimonials" class="mb-24 border-t border-gray-100 pt-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-8">
                <div class="max-w-2xl">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600">{{ __('public/home.testimonials_badge') }}</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mt-2">{{ __('public/home.testimonials_title') }}</h2>
                    <p class="text-gray-500 mt-3 leading-relaxed">{{ __('public/home.testimonials_subtitle') }}</p>
                </div>
                @if($testimonials->isNotEmpty())
                <div class="flex gap-2 shrink-0">
                    <button type="button" id="testimonials-prev" class="w-10 h-10 rounded-full border border-gray-200 text-gray-700 hover:bg-slate-900 hover:text-white transition" aria-label="{{ __('public/home.previous_testimonial') }}">&#8592;</button>
                    <button type="button" id="testimonials-next" class="w-10 h-10 rounded-full border border-gray-200 text-gray-700 hover:bg-slate-900 hover:text-white transition" aria-label="{{ __('public/home.next_testimonial') }}">&#8594;</button>
                </div>
                @endif
            </div>

            @if($testimonials->isNotEmpty())
            <div id="testimonials-slider" class="testimonials-scrollbar-hidden flex gap-6 overflow-x-auto snap-x snap-mandatory pb-5 -mx-4 px-4 sm:mx-0 sm:px-0 scroll-smooth">
                @foreach($testimonials as $testimonial)
                <article class="min-w-[min(88vw,360px)] md:min-w-0 md:flex-[0_0_calc((100%_-_3rem)/3)] h-72 flex flex-col snap-start bg-white rounded-2xl border border-gray-200/80 p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="flex gap-1 text-amber-500 mb-5" aria-label="5 {{ __('public/home.stars') }}">
                        @for($star = 1; $star <= 5; $star++)
                            <svg class="w-4 h-4 {{ $star <= $testimonial->rating ? 'fill-current' : 'fill-none' }}" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="m10 1.5 2.63 5.33 5.88.85-4.25 4.14 1 5.85L10 14.91l-5.26 2.76 1-5.85L1.5 7.68l5.88-.85L10 1.5Z" />
                            </svg>
                            @endfor
                    </div>
                    <blockquote class="testimonials-scrollbar-hidden flex-1 min-h-0 overflow-y-auto pr-2 text-gray-700 leading-relaxed">"{{ $testimonial->comment }}"</blockquote>
                    <footer class="mt-6 pt-4 border-t border-gray-100">
                        <p class="font-bold text-gray-900">{{ $testimonial->user->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $testimonial->created_at->translatedFormat('F Y') }}</p>
                    </footer>
                </article>
                @endforeach
            </div>
            @else
            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center text-gray-500">{{ __('public/home.testimonials_empty') }}</div>
            @endif

            <div class="mt-8 rounded-2xl bg-slate-900 border border-slate-800 p-6 md:p-8 text-white">
                @auth
                <h3 class="text-xl font-bold mb-1">{{ __('public/home.testimonial_form_title') }}</h3>
                <p class="text-sm text-gray-400 mb-5">{{ __('public/home.testimonial_form_subtitle') }}</p>
                <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-2">{{ __('public/home.rating') }}</label>
                        <div id="testimonial-rating" class="flex gap-2" role="radiogroup" aria-label="{{ __('public/home.rating') }}">
                            @for($rating = 1; $rating <= 5; $rating++)
                                <label class="cursor-pointer text-3xl leading-none transition-transform hover:scale-110">
                                <input type="radio" name="rating" value="{{ $rating }}" class="sr-only" {{ old('rating', 5) == $rating ? 'checked' : '' }} required>
                                <span data-rating-star="{{ $rating }}" class="text-slate-500 transition-colors" aria-hidden="true">&#9733;</span>
                                <span class="sr-only">{{ $rating }} {{ __('public/home.stars') }}</span>
                                </label>
                                @endfor
                        </div>
                        @error('rating')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="testimonial-comment" class="block text-xs font-semibold text-gray-300 mb-2">{{ __('public/home.testimonial_comment') }}</label>
                        <textarea id="testimonial-comment" name="comment" rows="3" required minlength="10" maxlength="1000" placeholder="{{ __('public/home.testimonial_placeholder') }}" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white placeholder-gray-500 text-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                        @error('comment')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-3 text-xs font-extrabold uppercase tracking-wider text-slate-950 hover:bg-amber-400 transition">{{ __('public/home.submit_testimonial') }}</button>
                </form>
                @else
                <h3 class="text-xl font-bold mb-2">{{ __('public/home.testimonial_login_title') }}</h3>
                <p class="text-sm text-gray-400 mb-5">{{ __('public/home.testimonial_login_subtitle') }}</p>
                <a href="{{ route('login', ['redirect' => url()->current() . '#testimonials']) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-3 text-xs font-extrabold uppercase tracking-wider text-slate-950 hover:bg-amber-400 transition">{{ __('public/home.testimonial_login') }}</a>
                @endauth
            </div>
        </section>

        <!-- FORMULAIRE DE REQUÊTE SOURCING -->
        <div id="vehicle-request" class="mt-12 bg-slate-950 rounded-3xl border border-slate-800 shadow-2xl p-8 md:p-12 text-white relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-2xl mb-8 relative z-10">
                <span class="inline-block text-xs font-extrabold uppercase tracking-widest text-amber-500 mb-2 bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">{{ __('public/home.finder_badge') }}</span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white mb-3">{{ __('public/home.finder_title') }}</h2>
                <p class="text-sm text-gray-400 leading-relaxed">{{ __('public/home.finder_subtitle') }}</p>
            </div>

            <form action="{{ route('vehicles.request') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5 relative z-10">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_make') }}</label>
                    <input type="text" name="make" placeholder="{{ __('public/home.placeholder_make') }}" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_model') }}</label>
                    <input type="text" name="model" placeholder="{{ __('public/home.placeholder_model') }}" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_year_min') }}</label>
                    <input type="number" name="year_min" placeholder="2018" min="1900" class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_year_max') }}</label>
                    <input type="number" name="year_max" placeholder="2024" min="1900" class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_max_budget') }}</label>
                    <input type="number" name="max_budget" placeholder="50000" min="0" class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_max_mileage') }}</label>
                    <input type="number" name="desired_mileage" placeholder="45000" min="0" class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_full_name') }}</label>
                    <input type="text" name="name" placeholder="John Doe" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_email') }}</label>
                    <input type="email" name="email" placeholder="john@example.com" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_phone') }}</label>
                    <input type="text" name="phone" placeholder="(405) 000-0000" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_zip') }}</label>
                    <input type="text" name="zip_code" placeholder="73112" required class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">{{ __('public/home.form_notes') }}</label>
                    <textarea name="notes" rows="3" placeholder="{{ __('public/home.placeholder_notes') }}" class="w-full text-xs font-medium py-3 px-4 rounded-xl bg-slate-900 border-slate-800 text-white placeholder-gray-500 focus:border-amber-500 focus:ring-amber-500 transition"></textarea>
                </div>
                <div class="md:col-span-2 pt-2">
                    <button type="submit" class="w-full py-4 px-6 bg-amber-500 hover:bg-amber-400 text-slate-950 rounded-xl font-extrabold text-sm transition-all duration-200 shadow-lg shadow-amber-500/20 uppercase tracking-wider flex items-center justify-center gap-2">
                        <span>{{ __('public/home.submit_sourcing') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <style>
        .testimonials-scrollbar-hidden {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .testimonials-scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- SCRIPT DE FILTRAGE AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const testimonialSlider = document.getElementById('testimonials-slider');
            const testimonialPrevious = document.getElementById('testimonials-prev');
            const testimonialNext = document.getElementById('testimonials-next');

            if (testimonialSlider && testimonialPrevious && testimonialNext) {
                let testimonialTimer;

                function moveTestimonials(direction) {
                    const pageWidth = testimonialSlider.clientWidth;
                    const lastPage = testimonialSlider.scrollWidth - pageWidth;
                    const nextPosition = testimonialSlider.scrollLeft + (direction * pageWidth);
                    const targetPosition = nextPosition > lastPage + 4 ? 0 : Math.max(nextPosition, 0);

                    testimonialSlider.scrollTo({
                        left: targetPosition,
                        behavior: 'smooth'
                    });
                }

                function startTestimonialAutoSlide() {
                    clearInterval(testimonialTimer);
                    testimonialTimer = setInterval(() => moveTestimonials(1), 5000);
                }

                testimonialPrevious.addEventListener('click', () => {
                    moveTestimonials(-1);
                    startTestimonialAutoSlide();
                });

                testimonialNext.addEventListener('click', () => {
                    moveTestimonials(1);
                    startTestimonialAutoSlide();
                });

                testimonialSlider.addEventListener('mouseenter', () => clearInterval(testimonialTimer));
                testimonialSlider.addEventListener('mouseleave', startTestimonialAutoSlide);
                testimonialSlider.addEventListener('focusin', () => clearInterval(testimonialTimer));
                testimonialSlider.addEventListener('focusout', startTestimonialAutoSlide);
                startTestimonialAutoSlide();
            }

            const rating = document.getElementById('testimonial-rating');
            if (rating) {
                const radios = rating.querySelectorAll('input[name="rating"]');
                const stars = rating.querySelectorAll('[data-rating-star]');

                function paintRating(value) {
                    stars.forEach(star => {
                        const isActive = Number(star.dataset.ratingStar) <= Number(value);
                        star.classList.toggle('text-amber-400', isActive);
                        star.classList.toggle('text-slate-500', !isActive);
                        star.classList.toggle('drop-shadow-[0_0_6px_rgba(251,191,36,0.45)]', isActive);
                    });
                }

                radios.forEach(radio => radio.addEventListener('change', () => paintRating(radio.value)));
                paintRating(rating.querySelector('input[name="rating"]:checked')?.value || 5);
            }

            const form = document.getElementById('filter-form');
            const grid = document.getElementById('vehicles-grid');
            const countSpan = document.getElementById('vehicle-count');
            const resetButton = document.getElementById('reset-filters');
            let timeout = null;

            function fetchFilteredVehicles() {
                grid.classList.add('opacity-50', 'pointer-events-none');

                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();

                fetch(`{{ route('vehicles.filter') }}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        grid.innerHTML = data.html;
                        countSpan.textContent = data.count;
                    })
                    .catch(error => console.error('Erreur de filtrage:', error))
                    .finally(() => {
                        grid.classList.remove('opacity-50', 'pointer-events-none');
                    });
            }

            form.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', fetchFilteredVehicles);
            });

            form.querySelector('#filter-search').addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(fetchFilteredVehicles, 300);
            });

            resetButton.addEventListener('click', function() {
                form.reset();
                fetchFilteredVehicles();
            });
        });
    </script>

</x-guest-layout>