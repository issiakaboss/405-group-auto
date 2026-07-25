<x-app-layout>
    <div class="min-h-screen bg-[#0b0f19] text-slate-100 p-6 md:p-10">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-white">Gestion des Administrateurs</h1>
                    <p class="text-sm text-slate-400 mt-1">Gérez les accès de l'équipe d'administration 405 Group Auto.</p>
                </div>
            </div>

            <!-- Formulaire de création rapide -->
            <div class="bg-[#111827] border border-slate-800 p-6 rounded-2xl shadow-xl">
                <h2 class="text-lg font-semibold text-white mb-4">Ajouter un Administrateur</h2>
                <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Nom complet</label>
                        <input type="text" name="name" required class="w-full bg-[#1f2937] border-slate-700 text-white text-sm rounded-xl focus:ring-amber-500 focus:border-amber-500" placeholder="Ex: Marc Dubois">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Adresse Email</label>
                        <input type="email" name="email" required class="w-full bg-[#1f2937] border-slate-700 text-white text-sm rounded-xl focus:ring-amber-500 focus:border-amber-500" placeholder="admin@405groupauto.com">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition duration-150">
                            ✉️ Créer et Envoyer l'accès
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table des Admins -->
            <div class="bg-[#111827] border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-[#1f2937]/50 text-xs uppercase text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">Ajouté le</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @foreach($admins as $admin)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-6 py-4 font-semibold text-white">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $admin->email }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-amber-500/10 text-amber-500 border border-amber-500/20 px-2.5 py-1 rounded-full text-xs font-semibold">
                                    Admin
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>