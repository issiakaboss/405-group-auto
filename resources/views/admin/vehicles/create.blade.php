<x-app-layout>
    <!-- Fond global très sombre (Dark Mode) -->
    <div class="py-12 bg-[#080d1a] min-h-screen text-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Bouton de retour en bleu clair/gris -->
            <div class="mb-6">
                <a href="{{ route('admin.vehicles.index') }}" class="text-xs font-bold text-slate-400 hover:text-white transition flex items-center space-x-1 uppercase tracking-wider">
                    ← Back to Fleet
                </a>
            </div>

            <!-- Carte principale sombre -->
            <div class="bg-[#0f172a] border border-slate-800/80 shadow-2xl rounded-2xl p-8 md:p-10">
                <div class="mb-8">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 block">Sourcing & Stock</span>
                    <h2 class="text-xl font-black text-white uppercase tracking-tight mt-1">Register New Car</h2>
                </div>

                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-slate-300">
                    @csrf

                    <!-- 1. Identification (Make, Model, Trim, Year) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Make / Constructeur</label>
                            <input type="text" name="make" value="{{ old('make') }}" placeholder="e.g. Chevrolet, Ford" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs" required>
                            @error('make') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Model / Série</label>
                            <input type="text" name="model" value="{{ old('model') }}" placeholder="e.g. Malibu Limited, Mustang" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs" required>
                            @error('model') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Trim (Optional)</label>
                            <input type="text" name="trim" value="{{ old('trim') }}" placeholder="e.g. LT, LS, GT" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs">
                            @error('trim') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Year</label>
                            <input type="number" name="year" value="{{ old('year') }}" placeholder="2024" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs" required>
                            @error('year') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 2. Classification (Vehicle Type & Body Style) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Vehicle Type</label>
                            <select name="vehicle_type" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs" required>
                                <option value="" class="bg-[#1e293b]">Select Type</option>
                                @foreach(\App\Models\Enums\VehicleType::cases() as $type)
                                <option value="{{ $type->value }}" class="bg-[#1e293b]" {{ old('vehicle_type') === $type->value ? 'selected' : '' }}>
                                    {{ $type->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('vehicle_type') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Body Style</label>
                            <select name="body_style" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs" required>
                                <option value="" class="bg-[#1e293b]">Select Body Style</option>
                                @foreach(\App\Models\Enums\BodyStyle::cases() as $style)
                                <option value="{{ $style->value }}" class="bg-[#1e293b]" {{ old('body_style') === $style->value ? 'selected' : '' }}>
                                    {{ $style->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('body_style') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 3. Specs & Colors (Exterior, Interior, Transmission, Fuel) -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Exterior Color</label>
                            <select name="exterior_color" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs" required>
                                <option value="" class="bg-[#1e293b]">Select Exterior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                <option value="{{ $color->value }}" class="bg-[#1e293b]" {{ old('exterior_color') === $color->value ? 'selected' : '' }}>
                                    {{ $color->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('exterior_color') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Interior Color</label>
                            <select name="interior_color" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs" required>
                                <option value="" class="bg-[#1e293b]">Select Interior</option>
                                @foreach(\App\Models\Enums\VehicleColor::cases() as $color)
                                <option value="{{ $color->value }}" class="bg-[#1e293b]" {{ old('interior_color') === $color->value ? 'selected' : '' }}>
                                    {{ $color->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('interior_color') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Transmission</label>
                            <select name="transmission" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs">
                                <option value="" class="bg-[#1e293b]">Select Transmission</option>
                                @foreach(\App\Models\Enums\Transmission::cases() as $trans)
                                <option value="{{ $trans->value }}" class="bg-[#1e293b]" {{ old('transmission') === $trans->value ? 'selected' : '' }}>
                                    {{ $trans->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('transmission') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Fuel Type</label>
                            <select name="fuel_type" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs">
                                <option value="" class="bg-[#1e293b]">Select Fuel</option>
                                @foreach(\App\Models\Enums\FuelType::cases() as $fuel)
                                <option value="{{ $fuel->value }}" class="bg-[#1e293b]" {{ old('fuel_type') === $fuel->value ? 'selected' : '' }}>
                                    {{ $fuel->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('fuel_type') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 4. Price, Mileage, Location (Prix vert brillant comme sur l'image) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Price ($ USD)</label>
                            <input type="number" name="price" value="{{ old('price') }}" placeholder="4999" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-emerald-500 focus:ring-0 text-emerald-400 font-bold placeholder-slate-500 transition text-xs" required>
                            @error('price') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Mileage (Miles)</label>
                            <input type="number" name="mileage" value="{{ old('mileage') }}" placeholder="163200" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs" required>
                            @error('mileage') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Location</label>
                            <select name="location" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs" required>
                                <option value="" class="bg-[#1e293b]">Select Location</option>
                                @foreach(\App\Models\Enums\VehicleLocation::cases() as $loc)
                                <option value="{{ $loc->value }}" class="bg-[#1e293b]" {{ old('location') === $loc->value ? 'selected' : '' }}>
                                    {{ $loc->label() }}
                                </option>
                                @endforeach
                            </select>
                            @error('location') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- 5. Legal & Financing Status -->
                    <div class="p-4 bg-[#182234] border border-slate-800 rounded-xl space-y-3">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" name="has_clean_title" id="has_clean_title" value="1" {{ old('has_clean_title') ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-600 bg-[#1e293b] text-indigo-500 focus:ring-0 focus:ring-offset-0">
                            <label for="has_clean_title" class="text-xs font-semibold text-slate-200 cursor-pointer">
                                This vehicle has a clean title (No significant damage or persistent problems).
                            </label>
                        </div>
                        <div class="pt-2 border-t border-slate-700/50">
                            <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Money Owed Status</label>
                            <select name="money_still_owed" class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white transition text-xs">
                                <option value="" class="bg-[#1e293b]">Select Financial Status</option>
                                @foreach(\App\Models\Enums\MoneyOwedStatus::cases() as $status)
                                <option value="{{ $status->value }}" class="bg-[#1e293b]" {{ old('money_still_owed') === $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 6. Description -->
                    <div>
                        <label class="block text-slate-400 mb-1.5 uppercase tracking-wider text-[11px]">Description</label>
                        <textarea name="description" rows="3" placeholder="Great deal, run and drive no issues..." class="w-full p-3 bg-[#1e293b] border border-slate-700/60 rounded-xl focus:border-indigo-500 focus:ring-0 text-white placeholder-slate-500 transition text-xs">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- 7. Upload Photos -->
                    <div class="pt-4 border-t border-slate-800">
                        <label class="block text-slate-200 text-sm font-bold mb-2">Upload Car Photos (Multiple Selection)</label>
                        <div class="border-2 border-dashed border-slate-700 hover:border-amber-500 rounded-2xl p-6 bg-[#182234] hover:bg-[#1e293b] transition duration-200 text-center relative group">
                            <input type="file" name="images[]" id="image-input" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                            <div class="space-y-1">
                                <span class="text-2xl block group-hover:scale-110 transition duration-200">📸</span>
                                <p class="text-white font-bold">Click to select multiple vehicle images</p>
                                <p class="text-[10px] text-slate-400 font-medium">JPEG, PNG, JPG or WEBP (Max 5MB per photo)</p>
                            </div>
                        </div>

                        <div id="images-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4"></div>
                        @error('images') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-3 bg-[#1e293b] hover:bg-slate-700 text-slate-300 rounded-xl transition uppercase tracking-wider font-bold">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl shadow-md transition uppercase tracking-wider font-extrabold">
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
                    div.className = 'relative group aspect-[16/10] bg-[#1e293b] border border-slate-700 rounded-xl overflow-hidden shadow-sm';

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button type="button" onclick="removeFile(${index})" class="absolute top-1.5 right-1.5 bg-red-500 hover:bg-red-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition duration-150 z-10">
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
    </script>
</x-app-layout>