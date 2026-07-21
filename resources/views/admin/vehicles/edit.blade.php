<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('admin.vehicles.index') }}" class="text-xs font-bold text-gray-400 hover:text-gray-900 transition flex items-center space-x-1 uppercase tracking-wider">
                    ← Back to Fleet
                </a>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-8 md:p-10">
                <div class="mb-8">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block">Sourcing & Update</span>
                    <h2 class="text-xl font-black text-gray-950 uppercase tracking-tight mt-1">Edit Car: {{ $vehicle->title }}</h2>
                </div>

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-gray-700">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Brand / Constructeur</label>
                            <input type="text" name="brand" value="{{ $vehicle->brand }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Model / Série</label>
                            <input type="text" name="model" value="{{ $vehicle->model }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Showroom Price ($ USD)</label>
                            <input type="number" name="price" value="{{ $vehicle->price }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Manufacturing Year</label>
                            <input type="number" name="year" value="{{ $vehicle->year }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Mileage (Miles)</label>
                            <input type="number" name="mileage" value="{{ $vehicle->mileage }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Transmission</label>
                            <select name="transmission" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="automatic" {{ $vehicle->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="manual" {{ $vehicle->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Fuel Type</label>
                            <select name="fuel_type" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="gasoline" {{ $vehicle->fuel_type == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                                <option value="diesel" {{ $vehicle->fuel_type == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="electric" {{ $vehicle->fuel_type == 'electric' ? 'selected' : '' }}>Electric</option>
                                <option value="hybrid" {{ $vehicle->fuel_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Vehicle Category</label>
                            <input type="text" name="category" value="{{ $vehicle->category }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Current Sourcing Location</label>
                            <input type="text" name="location" value="{{ $vehicle->location }}" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label class="block text-gray-900 text-sm font-bold mb-2">Update Car Photos (Leave empty to keep existing)</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 bg-gray-50 text-center hover:bg-gray-100/50 transition relative">
                            <input type="file" name="images[]" id="image-edit-input" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="space-y-1">
                                <span class="text-xl block">🔄</span>
                                <p class="text-gray-900 font-bold">Upload new images to replace or append</p>
                                <p class="text-[10px] text-gray-400 font-medium">JPEG, PNG, JPG or WEBP (Max 5MB per photo)</p>
                            </div>
                        </div>

                        <div id="images-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4">
                            @if($vehicle->images)
                            @foreach($vehicle->images as $img)
                            <div class="relative rounded-xl overflow-hidden border border-gray-100 shadow-sm aspect-[16/10]">
                                <img src="{{ $img }}" class="w-full h-full object-cover">
                                <span class="absolute top-1 left-1 bg-gray-950/70 text-[8px] text-white px-1.5 py-0.5 rounded font-bold">Active</span>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-xl transition uppercase tracking-wider font-bold">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gray-950 hover:bg-gray-800 text-white rounded-xl shadow-sm transition uppercase tracking-wider font-bold">
                            Update Vehicle
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('image-edit-input').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('images-preview');
            // Optionnel : On efface l'aperçu de la BDD uniquement si l'user fait un choix de fichiers pour montrer ce qui va être envoyé
            previewContainer.innerHTML = '';

            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group aspect-[16/10] bg-gray-50 border border-gray-100 rounded-xl overflow-hidden shadow-sm';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute top-1 left-1 bg-emerald-600 text-[8px] text-white px-1.5 py-0.5 rounded font-bold">New</div>
                        `;
                        previewContainer.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
</x-app-layout>