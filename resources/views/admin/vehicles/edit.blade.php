<x-app-layout>
    <div class="py-8 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-400 hover:text-white transition uppercase tracking-wider">
                    <span>← {{ __('admin/vehicles.back_to_fleet') }}</span>
                </a>
            </div>

            <div class="bg-slate-900 border border-slate-800 shadow-xl rounded-2xl p-6 sm:p-8 md:p-10">
                <div class="mb-8 border-b border-slate-800 pb-5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-blue-400 block">{{ __('admin/vehicles.sourcing_update') }}</span>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight mt-1">{{ __('admin/vehicles.edit_vehicle') }} {{ $vehicle->title ?? $vehicle->make . ' ' . $vehicle->model }}</h1>
                </div>

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-slate-300">
                    @csrf
                    @method('PUT')

                    <!-- Container pour les images supprimées -->
                    <div id="deleted-images-container"></div>

                    <!-- 1. Identification -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.make') }}</label>
                            <input type="text" name="make" value="{{ old('make', $vehicle->make) }}" placeholder="ex. Chevrolet, Ford" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('make') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.model') }}</label>
                            <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" placeholder="ex. Malibu Limited, Mustang" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('model') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.trim') }}</label>
                            <input type="text" name="trim" value="{{ old('trim', $vehicle->trim) }}" placeholder="ex. LT, LS, GT" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                            @error('trim') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.year') }}</label>
                            <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" placeholder="2024" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('year') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 2. Classification -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.vehicle_type') }}</label>
                            <select name="vehicle_type" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">{{ __('admin/vehicles.select_type') }}</option>
                                @foreach(\App\Models\Enums\VehicleType::cases() as $type)
                                    @php $currentType = $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type; @endphp
                                    <option value="{{ $type->value }}" {{ old('vehicle_type', $currentType) == $type->value ? 'selected' : '' }}>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_type') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.body_style') }}</label>
                            <select name="body_style" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">{{ __('admin/vehicles.select_style') }}</option>
                                @foreach(\App\Models\Enums\BodyStyle::cases() as $style)
                                    @php $currentStyle = $vehicle->body_style?->value ?? $vehicle->body_style; @endphp
                                    <option value="{{ $style->value }}" {{ old('body_style', $currentStyle) == $style->value ? 'selected' : '' }}>
                                        {{ $style->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('body_style') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 3. Spécifications & Couleurs -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.exterior_color') }}</label>
                            <select name="exterior_color" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">{{ __('admin/vehicles.select_exterior') }}</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                    @php $currentExtColor = $vehicle->exterior_color?->value ?? $vehicle->exterior_color; @endphp
                                    <option value="{{ $color->value }}" {{ old('exterior_color', $currentExtColor) == $color->value ? 'selected' : '' }}>
                                        {{ $color->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('exterior_color') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.interior_color') }}</label>
                            <select name="interior_color" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">{{ __('admin/vehicles.select_interior') }}</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                    @php $currentIntColor = $vehicle->interior_color?->value ?? $vehicle->interior_color; @endphp
                                    <option value="{{ $color->value }}" {{ old('interior_color', $currentIntColor) == $color->value ? 'selected' : '' }}>
                                        {{ $color->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('interior_color') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.transmission') }}</label>
                            <select name="transmission" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                                <option value="">{{ __('admin/vehicles.select_transmission') }}</option>
                                @foreach(\App\Models\Enums\Transmission::cases() as $trans)
                                    @php $currentTrans = $vehicle->transmission?->value ?? $vehicle->transmission; @endphp
                                    <option value="{{ $trans->value }}" {{ old('transmission', $currentTrans) == $trans->value ? 'selected' : '' }}>
                                        {{ $trans->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('transmission') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.fuel_type') }}</label>
                            <select name="fuel_type" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                                <option value="">{{ __('admin/vehicles.select_fuel') }}</option>
                                @foreach(\App\Models\Enums\FuelType::cases() as $fuel)
                                    @php $currentFuel = $vehicle->fuel_type?->value ?? $vehicle->fuel_type; @endphp
                                    <option value="{{ $fuel->value }}" {{ old('fuel_type', $currentFuel) == $fuel->value ? 'selected' : '' }}>
                                        {{ $fuel->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fuel_type') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 4. Prix, Kilométrage, Emplacement -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.price_usd') }}</label>
                            <input type="number" name="price" value="{{ old('price', $vehicle->price) }}" placeholder="4999" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-emerald-400 font-bold placeholder-slate-500 focus:bg-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition text-xs" required>
                            @error('price') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.mileage_miles') }}</label>
                            <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" placeholder="163200" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('mileage') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.location') }}</label>
                            <select name="location" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">{{ __('admin/vehicles.select_location') }}</option>
                                @foreach(\App\Models\Enums\VehicleLocation::cases() as $loc)
                                    @php $currentLoc = $vehicle->location?->value ?? $vehicle->location; @endphp
                                    <option value="{{ $loc->value }}" {{ old('location', $currentLoc) == $loc->value ? 'selected' : '' }}>
                                        {{ $loc->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 5. Statut légal et financier -->
                    <div class="p-4 bg-slate-800/50 border border-slate-800 rounded-xl space-y-3">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" name="has_clean_title" id="has_clean_title" value="1" {{ old('has_clean_title', $vehicle->has_clean_title) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-600 bg-slate-800 text-blue-500 focus:ring-0 focus:ring-offset-0">
                            <label for="has_clean_title" class="text-xs font-semibold text-slate-200 cursor-pointer">
                                {{ __('admin/vehicles.clean_title_notice') }}
                            </label>
                        </div>
                    </div>

                    <!-- 6. Description -->
                    <div>
                        <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">{{ __('admin/vehicles.description') }}</label>
                        <textarea name="description" rows="3" placeholder="..." class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">{{ old('description', $vehicle->description) }}</textarea>
                        @error('description') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- 7. Téléversement de photos -->
                    <div class="pt-4 border-t border-slate-800">
                        <label class="block text-slate-200 text-xs font-bold mb-2 uppercase tracking-wider">{{ __('admin/vehicles.add_photos') }}</label>
                        <div class="border-2 border-dashed border-slate-700 hover:border-blue-500 rounded-2xl p-6 bg-slate-800/40 hover:bg-slate-800/80 transition duration-200 text-center relative group">
                            <input type="file" name="images[]" id="image-input" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="space-y-1">
                                <span class="text-2xl block group-hover:scale-110 transition duration-200">📸</span>
                                <p class="text-white font-bold">{{ __('admin/vehicles.upload_instruction') }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ __('admin/vehicles.upload_formats') }}</p>
                            </div>
                        </div>

                        <!-- Prévisualisation des images existantes avec suppression -->
                        @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                        <div class="mt-4">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Images existantes</span>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                @foreach($vehicle->images as $img)
                                <div class="relative group aspect-[16/10] bg-slate-800 border border-slate-700 rounded-xl overflow-hidden shadow-sm" id="existing-img-{{ $loop->index }}">
                                    <img src="{{ $img }}" class="w-full h-full object-cover">
                                    <button type="button" onclick="removeExistingImage('{{ $img }}', 'existing-img-{{ $loop->index }}')" class="absolute top-1.5 right-1.5 bg-rose-500 hover:bg-rose-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition duration-150 z-10">
                                        ✕
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div id="images-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4"></div>
                        @error('images') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Actions -->
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition uppercase tracking-wider font-bold text-xs">
                            {{ __('admin/vehicles.cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl shadow-md transition uppercase tracking-wider font-extrabold text-xs">
                            {{ __('admin/vehicles.update_vehicle') }}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        let selectedFiles = new DataTransfer();
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('images-preview');

        imageInput.addEventListener('change', function(event) {
            const files = event.target.files;
            if (!files) return;

            Array.from(files).forEach(file => {
                selectedFiles.items.add(file);
            });

            imageInput.files = selectedFiles.files;
            renderPreviews();
        });

        function renderPreviews() {
            previewContainer.innerHTML = '';

            Array.from(selectedFiles.files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group aspect-[16/10] bg-slate-800 border border-slate-700 rounded-xl overflow-hidden shadow-sm';

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button type="button" onclick="removeFile(${index})" class="absolute top-1.5 right-1.5 bg-rose-500 hover:bg-rose-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition duration-150 z-10">
                            ✕
                        </button>
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center p-1 text-[9px] text-white font-bold tracking-tight">
                            ${(file.size / 1024 / 1024).toFixed(1)} MB
                        </div>
                    `;
                    previewContainer.appendChild(div);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeFile(indexToRemove) {
            const dt = new DataTransfer();
            const files = imageInput.files;

            Array.from(files).forEach((file, index) => {
                if (index !== indexToRemove) {
                    dt.items.add(file);
                }
            });

            selectedFiles = dt;
            imageInput.files = selectedFiles.files;

            if (selectedFiles.files.length === 0) {
                imageInput.value = '';
            }

            renderPreviews();
        }

        function removeExistingImage(imagePath, elementId) {
            const container = document.getElementById('deleted-images-container');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleted_images[]';
            input.value = imagePath;
            container.appendChild(input);

            const element = document.getElementById(elementId);
            if (element) {
                element.remove();
            }
        }
    </script>
</x-app-layout>