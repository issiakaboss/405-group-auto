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
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block">Sourcing & Stock</span>
                    <h2 class="text-xl font-black text-gray-950 uppercase tracking-tight mt-1">Register New Car</h2>
                </div>

                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-semibold text-gray-700">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Brand / Constructeur</label>
                            <input type="text" name="brand" placeholder="e.g. Mercedes-Benz, Ford" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Model / Série</label>
                            <input type="text" name="model" placeholder="e.g. Mustang GT, C-Class" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Showroom Price ($ USD)</label>
                            <input type="number" name="price" placeholder="45000" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Manufacturing Year</label>
                            <input type="number" name="year" placeholder="2024" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Mileage (Miles)</label>
                            <input type="number" name="mileage" placeholder="12000" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Transmission</label>
                            <select name="transmission" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Fuel Type</label>
                            <select name="fuel_type" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs">
                                <option value="gasoline">Gasoline</option>
                                <option value="diesel">Diesel</option>
                                <option value="electric">Electric</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1.5">Vehicle Category</label>
                            <input type="text" name="category" placeholder="e.g. Sedan, SUV, Sports" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1.5">Current Sourcing Location</label>
                            <input type="text" name="location" placeholder="e.g. Houston, TX (In Transit)" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-950 focus:ring-0 transition text-xs" required>
                        </div>
                    </div>

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
                    </div>

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
        // 💡 On crée un conteneur global pour stocker les fichiers actifs
        let selectedFiles = new DataTransfer();
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('images-preview');

        imageInput.addEventListener('change', function(event) {
            const files = event.target.files;
            if (!files) return;

            // Ajouter les nouveaux fichiers sélectionnés à notre liste globale
            Array.from(files).forEach(file => {
                selectedFiles.items.add(file);
            });

            // Mettre à jour l'input avec la liste totale
            imageInput.files = selectedFiles.files;

            // Rafraîchir l'affichage des miniatures
            renderPreviews();
        });

        function renderPreviews() {
            previewContainer.innerHTML = ''; // On vide pour reconstruire proprement

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

        // 💡 Fonction déclenchée au clic sur le bouton "✕"
        function removeFile(indexToRemove) {
            const dt = new DataTransfer();
            const files = imageInput.files;

            // On reconstruit une nouvelle liste de fichiers en sautant celui qu'on veut supprimer
            Array.from(files).forEach((file, index) => {
                if (index !== indexToRemove) {
                    dt.items.add(file);
                }
            });

            // On synchronise notre variable globale et l'input de fichier
            selectedFiles = dt;
            imageInput.files = selectedFiles.files;

            // Si plus aucun fichier n'est sélectionné et que le champ était requis
            if (selectedFiles.files.length === 0) {
                imageInput.value = ''; // Réinitialise l'élément HTML
            }

            // On redessine le preview mis à jour
            renderPreviews();
        }
    </script>
</x-app-layout>