<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('admin.vehicles.index') }}" class="text-xs font-bold text-gray-400 hover:text-gray-900 transition flex items-center space-x-1 uppercase tracking-wider">
                    ← Back to Fleet
                </a>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-8 md:p-10">
                <div class="mb-8">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block">Sourcing & Stock</span>
                    <h2 class="text-xl font-black text-gray-950 uppercase tracking-tight mt-1">Register New Car</h2>
                </div>

                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-gray-700">
                    @csrf

                    <!-- 1. Identification (Make, Model, Trim, Year) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Make / Constructeur</label>
                            <input type="text" name="make" value="{{ old('make') }}" placeholder="e.g. Chevrolet, Ford" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('make') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Model / Série</label>
                            <input type="text" name="model" value="{{ old('model') }}" placeholder="e.g. Malibu Limited, Mustang" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('model') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Trim (Optional)</label>
                            <input type="text" name="trim" value="{{ old('trim') }}" placeholder="e.g. LT, LS, GT" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                            @error('trim') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Year</label>
                            <input type="number" name="year" value="{{ old('year') }}" placeholder="2024" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('year') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 2. Classification (Vehicle Type & Body Style) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Vehicle Type</label>
                            <select name="vehicle_type" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                                <option value="">Select Type</option>
                                @foreach(\App\Models\Enums\VehicleType::cases() as $type)
                                    <option value="{{ $type->value }}" {{ old('vehicle_type') === $type->value ? 'selected' : '' }}>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_type') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Body Style</label>
                            <select name="body_style" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                                <option value="">Select Body Style</option>
                                @foreach(\App\Models\Enums\BodyStyle::cases() as $style)
                                    <option value="{{ $style->value }}" {{ old('body_style') === $style->value ? 'selected' : '' }}>
                                        {{ $style->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('body_style') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 3. Specs & Colors (Exterior, Interior, Transmission, Fuel) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Exterior Color</label>
                            <select name="exterior_color" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                                <option value="">Select Exterior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                    <option value="{{ $color->value }}" {{ old('exterior_color') === $color->value ? 'selected' : '' }}>
                                        {{ $color->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('exterior_color') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Interior Color</label>
                            <select name="interior_color" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                                <option value="">Select Interior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                    <option value="{{ $color->value }}" {{ old('interior_color') === $color->value ? 'selected' : '' }}>
                                        {{ $color->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('interior_color') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Transmission</label>
                            <select name="transmission" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="">Select Transmission</option>
                                @foreach(\App\Models\Enums\Transmission::cases() as $trans)
                                    <option value="{{ $trans->value }}" {{ old('transmission') === $trans->value ? 'selected' : '' }}>
                                        {{ $trans->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('transmission') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Fuel Type</label>
                            <select name="fuel_type" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="">Select Fuel</option>
                                @foreach(\App\Models\Enums\FuelType::cases() as $fuel)
                                    <option value="{{ $fuel->value }}" {{ old('fuel_type') === $fuel->value ? 'selected' : '' }}>
                                        {{ $fuel->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fuel_type') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 4. Price, Mileage, Location (ZIP Code) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Price ($ USD)</label>
                            <input type="number" name="price" value="{{ old('price') }}" placeholder="4999" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('price') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Mileage (Miles)</label>
                            <input type="number" name="mileage" value="{{ old('mileage') }}" placeholder="163200" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('mileage') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Location (US ZIP Code / City)</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. 73112 or Oklahoma City, OK" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                            @error('location') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 5. Legal & Financing Status (Clean Title & Money Owed) -->
                    <div class="p-4 bg-gray-50/80 border border-gray-200 rounded-xl space-y-3">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" name="has_clean_title" id="has_clean_title" value="1" {{ old('has_clean_title') ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 text-gray-950 focus:ring-0">
                            <label for="has_clean_title" class="text-xs font-bold text-gray-800 cursor-pointer">
                                This vehicle has a clean title (No significant damage or persistent problems).
                            </label>
                        </div>
                        <div class="pt-2 border-t border-gray-200/60">
                            <label class="block text-gray-600 mb-1.5">Money Owed Status</label>
                            <select name="money_still_owed" class="w-full p-3 bg-white border border-gray-200 rounded-xl focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="">Select Financial Status</option>
                                @foreach(\App\Models\Enums\MoneyOwedStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ old('money_still_owed') === $status->value ? 'selected' : '' }}>
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 6. Description -->
                    <div>
                        <label class="block text-gray-600 mb-1.5">Description</label>
                        <textarea name="description" rows="3" placeholder="Great deal, run and drive no issues. Available at 405 Auto Group..." class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- 7. Upload Photos -->
                    <div class="pt-4 border-t border-gray-100">
                        <label class="block text-gray-900 text-sm font-bold mb-2">Upload Car Photos (Multiple Selection)</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 bg-gray-50 text-center hover:bg-gray-100/50 transition relative">
                            <input type="file" name="images[]" id="image-input" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                            <div class="space-y-1">
                                <span class="text-xl block">📸</span>
                                <p class="text-gray-900 font-bold">Click to select multiple vehicle images</p>
                                <p class="text-[10px] text-gray-400 font-medium">JPEG, PNG, JPG or WEBP (Max 5MB per photo)</p>
                            </div>
                        </div>

                        <div id="images-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4"></div>
                        @error('images') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-xl transition uppercase tracking-wider font-bold">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gray-950 hover:bg-gray-800 text-white rounded-xl shadow-sm transition uppercase tracking-wider font-bold">
                            Save Vehicle
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
                    div.className = 'relative group aspect-[16/10] bg-gray-50 border border-gray-100 rounded-xl overflow-hidden shadow-sm';

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button type="button" onclick="removeFile(${index})" class="absolute top-1.5 right-1.5 bg-red-500 hover:bg-red-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition duration-150 z-10">
                            ✕
                        </button>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center p-1 text-[9px] text-white font-bold tracking-tight">
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
    </script>
</x-app-layout>