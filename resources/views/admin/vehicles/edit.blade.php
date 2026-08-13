<x-app-layout>
    <div class="py-8 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Bouton Retour -->
            <div class="mb-6">
                <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-400 hover:text-white transition uppercase tracking-wider">
                    <span>← Back to Fleet</span>
                </a>
            </div>

            <!-- Carte Formulaire -->
            <div class="bg-slate-900 border border-slate-800 shadow-xl rounded-2xl p-6 sm:p-8 md:p-10">
                <div class="mb-8 border-b border-slate-800 pb-5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-blue-400 block">Sourcing & Update</span>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight mt-1">Edit Car: {{ $vehicle->title ?? $vehicle->make . ' ' . $vehicle->model }}</h1>
                </div>

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-slate-300">
                    @csrf
                    @method('PUT')

                    <!-- 1. Identification (Make, Model, Trim, Year) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Make / Constructeur</label>
                            <input type="text" name="make" value="{{ old('make', $vehicle->make) }}" placeholder="e.g. Chevrolet, Ford" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('make') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Model / Série</label>
                            <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" placeholder="e.g. Malibu Limited, Mustang" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('model') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Trim (Optional)</label>
                            <input type="text" name="trim" value="{{ old('trim', $vehicle->trim) }}" placeholder="e.g. LT, LS, GT" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                            @error('trim') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Year</label>
                            <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" placeholder="2024" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('year') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 2. Classification (Vehicle Type & Body Style) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Vehicle Type</label>
                            <select name="vehicle_type" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">Select Type</option>
                                @foreach(\App\Models\Enums\VehicleType::cases() as $type)
                                <option value="{{ $type->value }}" {{ old('vehicle_type', $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type) == $type->value ? 'selected' : '' }}>
                                    {{ method_exists($type, 'label') ? $type->label() : $type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('vehicle_type') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Body Style</label>
                            <select name="body_style" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">Select Body Style</option>
                                @foreach(\App\Models\Enums\BodyStyle::cases() as $style)
                                <option value="{{ $style->value }}" {{ old('body_style', $vehicle->body_style?->value ?? $vehicle->body_style) == $style->value ? 'selected' : '' }}>
                                    {{ method_exists($style, 'label') ? $style->label() : $style->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('body_style') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 3. Specs & Colors (Exterior, Interior, Transmission, Fuel) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Exterior Color</label>
                            <select name="exterior_color" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">Select Exterior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                <option value="{{ $color->value }}" {{ old('exterior_color', $vehicle->exterior_color?->value ?? $vehicle->exterior_color) == $color->value ? 'selected' : '' }}>
                                    {{ method_exists($color, 'label') ? $color->label() : $color->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('exterior_color') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Interior Color</label>
                            <select name="interior_color" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="">Select Interior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                <option value="{{ $color->value }}" {{ old('interior_color', $vehicle->interior_color?->value ?? $vehicle->interior_color) == $color->value ? 'selected' : '' }}>
                                    {{ method_exists($color, 'label') ? $color->label() : $color->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('interior_color') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Transmission</label>
                            <select name="transmission" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                                <option value="">Select Transmission</option>
                                @foreach(\App\Models\Enums\Transmission::cases() as $trans)
                                <option value="{{ $trans->value }}" {{ old('transmission', $vehicle->transmission?->value ?? $vehicle->transmission) == $trans->value ? 'selected' : '' }}>
                                    {{ method_exists($trans, 'label') ? $trans->label() : $trans->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('transmission') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Fuel Type</label>
                            <select name="fuel_type" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                                <option value="">Select Fuel</option>
                                @foreach(\App\Models\Enums\FuelType::cases() as $fuel)
                                <option value="{{ $fuel->value }}" {{ old('fuel_type', $vehicle->fuel_type?->value ?? $vehicle->fuel_type) == $fuel->value ? 'selected' : '' }}>
                                    {{ method_exists($fuel, 'label') ? $fuel->label() : $fuel->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('fuel_type') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 4. Price, Mileage, Location -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Showroom Price ($ USD)</label>
                            <input type="number" name="price" value="{{ old('price', $vehicle->price) }}" placeholder="4999" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-emerald-400 font-bold placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('price') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Mileage (Miles)</label>
                            <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" placeholder="163200" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                            @error('mileage') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Current Sourcing Location</label>
                            <select name="location" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs" required>
                                <option value="" class="bg-slate-800">Select Location</option>
                                @foreach(\App\Models\Enums\VehicleLocation::cases() as $loc)
                                <option value="{{ $loc->value }}" class="bg-slate-800"
                                    {{ old('location', is_object($vehicle->location) ? $vehicle->location->value : $vehicle->location) === $loc->value ? 'selected' : '' }}>
                                    {{ $loc->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('location') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 5. Legal & Financing Status -->
                    <div class="p-4 bg-slate-800/50 border border-slate-800 rounded-xl space-y-3">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" name="has_clean_title" id="has_clean_title" value="1" {{ old('has_clean_title', $vehicle->has_clean_title) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-0 focus:ring-offset-0">
                            <label for="has_clean_title" class="text-xs font-bold text-slate-200 cursor-pointer">
                                This vehicle has a clean title (No significant damage or persistent problems).
                            </label>
                        </div>
                        <div class="pt-2 border-t border-slate-800">
                            <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Money Owed Status</label>
                            <select name="money_still_owed" class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">
                                <option value="">Select Financial Status</option>
                                @foreach(\App\Models\Enums\MoneyOwedStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('money_still_owed', $vehicle->money_still_owed?->value ?? $vehicle->money_still_owed) == $status->value ? 'selected' : '' }}>
                                    {{ method_exists($status, 'label') ? $status->label() : $status->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 6. Description -->
                    <div>
                        <label class="block text-slate-400 mb-1.5 uppercase text-[10px] tracking-wider font-bold">Description</label>
                        <textarea name="description" rows="3" placeholder="Great deal, run and drive no issues..." class="w-full p-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:bg-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-xs">{{ old('description', $vehicle->description) }}</textarea>
                        @error('description') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- 7. Photos Section -->
                    <div class="pt-4 border-t border-slate-800">
                        <label class="block text-white text-sm font-bold mb-2">Update Car Photos <span class="text-slate-400 text-xs font-normal">(Leave empty to keep existing)</span></label>

                        <div class="border-2 border-dashed border-slate-700 rounded-2xl p-6 bg-slate-800/40 text-center hover:bg-slate-800/80 hover:border-blue-500 transition relative group">
                            <input type="file" name="images[]" id="image-edit-input" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="space-y-1">
                                <span class="text-2xl block">🔄</span>
                                <p class="text-slate-200 font-bold group-hover:text-blue-400 transition">Upload new images to replace or append</p>
                                <p class="text-[10px] text-slate-400 font-medium">JPEG, PNG, JPG or WEBP (Max 5MB per photo)</p>
                            </div>
                        </div>

                        <!-- Champ caché pour stocker les images à supprimer -->
                        <div id="deleted-images-container"></div>

                        <!-- Galerie combinée -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4" id="existing-images-container">
                            @if(is_array($vehicle->images))
                            @foreach($vehicle->images as $index => $imagePath)
                            <div class="relative group aspect-[16/10] bg-slate-800 border border-slate-700 rounded-xl overflow-hidden shadow-sm" id="image-card-{{ $index }}">
                                <img src="{{ asset($imagePath) }}" class="w-full h-full object-cover">

                                <span class="absolute top-1.5 left-1.5 bg-slate-900/80 text-emerald-400 text-[10px] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm border border-emerald-500/20">
                                    Active
                                </span>

                                <button type="button"
                                    onclick="requestImageDeletion('{{ $imagePath }}', 'image-card-{{ $index }}')"
                                    class="absolute top-1.5 right-1.5 bg-rose-600 hover:bg-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-black shadow-md transition duration-150 z-10">
                                    ✕
                                </button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @error('images') <p class="text-rose-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition uppercase tracking-wider font-bold text-xs">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl shadow-sm transition uppercase tracking-wider font-bold text-xs">
                            Update Vehicle
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Composant Modal de confirmation -->
    <x-confirm-modal
        name="delete-photo-modal"
        title="Delete Photo?"
        message="Are you sure you want to remove this photo from the vehicle profile?"
        confirmText="Yes, Remove"
        cancelText="Cancel"
        type="danger" />

    <script>
        let selectedFilesMap = new Map();
        const editImageInput = document.getElementById('image-edit-input');
        const imagesGrid = document.getElementById('existing-images-container');

        editImageInput.addEventListener('change', function(event) {
            const files = Array.from(event.target.files);
            if (!files.length) return;

            files.forEach(file => {
                const fileKey = `${file.name}-${file.size}-${file.lastModified}`;
                if (!selectedFilesMap.has(fileKey)) {
                    selectedFilesMap.set(fileKey, file);
                    renderNewImagePreview(file, fileKey);
                }
            });

            syncInputFiles();
        });

        function renderNewImagePreview(file, fileKey) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group aspect-[16/10] bg-slate-800 border-2 border-dashed border-blue-500 rounded-xl overflow-hidden shadow-sm';
                div.id = `new-img-${fileKey}`;

                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <span class="absolute top-1.5 left-1.5 bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow">
                        New
                    </span>
                    <button type="button" 
                            onclick="removeNewFile('${fileKey}')" 
                            class="absolute top-1.5 right-1.5 bg-rose-600 hover:bg-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-black shadow-md transition duration-150 z-10">
                        ✕
                    </button>
                    <div class="absolute bottom-1 right-1 bg-slate-900/80 text-slate-300 text-[9px] font-bold px-1.5 py-0.5 rounded backdrop-blur-sm border border-slate-700">
                        ${(file.size / 1024 / 1024).toFixed(1)} MB
                    </div>
                `;

                imagesGrid.appendChild(div);
            };

            reader.readAsDataURL(file);
        }

        function removeNewFile(fileKey) {
            selectedFilesMap.delete(fileKey);
            const card = document.getElementById(`new-img-${fileKey}`);
            if (card) {
                card.remove();
            }
            syncInputFiles();
        }

        function syncInputFiles() {
            const dt = new DataTransfer();
            selectedFilesMap.forEach(file => dt.items.add(file));
            editImageInput.files = dt.files;
        }

        function requestImageDeletion(imagePath, cardId) {
            window.dispatchEvent(new CustomEvent('open-modal-delete-photo-modal', {
                detail: {
                    imagePath,
                    cardId
                }
            }));
        }

        window.addEventListener('confirmed-delete-photo-modal', function(event) {
            const {
                imagePath,
                cardId
            } = event.detail;

            const container = document.getElementById('deleted-images-container');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleted_images[]';
            input.value = imagePath;
            container.appendChild(input);

            const card = document.getElementById(cardId);
            if (card) {
                card.remove();
            }
        });
    </script>
</x-app-layout>