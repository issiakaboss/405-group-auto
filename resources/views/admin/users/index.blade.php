<x-app-layout>
    <div class="min-h-screen bg-[#080d1a] text-slate-100 py-10 px-4 sm:px-6 lg:px-8" x-data="{ editModalOpen: false, activeUser: null }">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-800/80 pb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white uppercase">Administrator Management</h1>
                    <p class="text-xs text-slate-400 mt-1">Manage team access, edit administrative permissions, and control security status.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-xs font-medium text-slate-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Total Admins: <strong class="text-white">{{ $admins->count() }}</strong>
                    </span>
                </div>
            </div>


            <!-- Quick Create Administrator Form -->
            <div class="bg-[#0f172a] border border-slate-800/80 p-6 rounded-2xl shadow-2xl">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider">Add New Administrator</h2>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Full Name</label>
                        <input type="text" name="name" required
                            class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition"
                            placeholder="e.g. Marc Dubois">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Email Address</label>
                        <input type="email" name="email" required
                            class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition"
                            placeholder="admin@405groupauto.com">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 px-4 rounded-lg text-xs transition duration-150 flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Create & Send Invitation</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Administrator Table -->
            <div class="bg-[#0f172a] border border-slate-800/80 rounded-2xl shadow-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-800/80 flex items-center justify-between">
                    <h3 class="text-xs font-bold text-slate-300 uppercase tracking-wider">Active Administrative Accounts</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-300">
                        <thead class="bg-slate-900/60 text-[11px] uppercase tracking-wider text-slate-400 border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-3.5 font-semibold">User</th>
                                <th class="px-6 py-3.5 font-semibold">Role</th>
                                <th class="px-6 py-3.5 font-semibold">Status</th>
                                <th class="px-6 py-3.5 font-semibold">Added On</th>
                                <th class="px-6 py-3.5 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @foreach($admins as $admin)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-amber-400 font-bold text-xs uppercase">
                                            {{ substr($admin->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $admin->name }}</div>
                                            <div class="text-[11px] text-slate-400">{{ $admin->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($admin->is_blocked) && $admin->is_blocked)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        Suspended
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ $admin->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit Button -->
                                        <button type="button"
                                            @click="activeUser = { id: '{{ $admin->id }}', name: '{{ addslashes($admin->name) }}', email: '{{ $admin->email }}' }; editModalOpen = true"
                                            class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-200 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <!-- Block / Unblock Form Button -->
                                        @if(auth()->id() !== $admin->id)
                                        <form id="toggle-block-form-{{ $admin->id }}" action="{{ route('admin.users.toggle-block', $admin->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')

                                            @if(isset($admin->is_blocked) && $admin->is_blocked)
                                            <button type="button"
                                                onclick="requestToggleBlock({{$admin->id}}, 'unblock')"
                                                class="px-3 py-1.5 bg-emerald-950/40 hover:bg-emerald-900/60 border border-emerald-800/80 text-emerald-300 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                </svg>
                                                Unblock
                                            </button>
                                            @else
                                            <button type="button"
                                                onclick="requestToggleBlock({{ $admin->id }}, 'block')"
                                                class="px-3 py-1.5 bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/80 text-rose-300 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zM12 9a3 3 0 100-6 3 3 0 000 6z" />
                                                </svg>
                                                Block
                                            </button>
                                            @endif
                                        </form>
                                        @else
                                        <span class="text-[11px] text-slate-500 italic px-2">You</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Edit Administrator Modal -->
        <div x-show="editModalOpen"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div @click.away="editModalOpen = false" class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl text-slate-100 space-y-5">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Edit Administrator</h3>
                    <button @click="editModalOpen = false" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form x-bind:action="'/admin/users/' + (activeUser ? activeUser.id : '')" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Full Name</label>
                        <input type="text" name="name" x-model="activeUser.name" required
                            class="w-full text-xs bg-slate-800 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Email Address</label>
                        <input type="email" name="email" x-model="activeUser.email" required
                            class="w-full text-xs bg-slate-800 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition">
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                        <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-semibold text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-lg transition border border-slate-700">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-xs font-bold text-slate-950 bg-amber-500 hover:bg-amber-400 rounded-lg transition shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Modal de confirmation pour bloquer -->
    <x-confirm-modal
        name="block-admin-modal"
        title="Suspend Administrator?"
        message="Are you sure you want to suspend this administrator account? They will lose access immediately."
        confirmText="Yes, Suspend"
        cancelText="Cancel"
        type="danger" />

    <!-- Modal de confirmation pour débloquer -->
    <x-confirm-modal
        name="unblock-admin-modal"
        title="Unblock Administrator?"
        message="Are you sure you want to reactivate this administrator account?"
        confirmText="Yes, Reactivate"
        cancelText="Cancel"
        type="info" />

    <script>
        function requestToggleBlock(adminId, action) {
            const modalName = action === 'block' ? 'block-admin-modal' : 'unblock-admin-modal';
            window.dispatchEvent(new CustomEvent(`open-modal-${modalName}`, {
                detail: {
                    adminId: adminId
                }
            }));
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Confirmation pour le blocage
            window.addEventListener('confirmed-block-admin-modal', function(event) {
                if (event.detail && event.detail.adminId) {
                    const form = document.getElementById(`toggle-block-form-${event.detail.adminId}`);
                    if (form) {
                        form.submit();
                    }
                }
            });

            // Confirmation pour le déblocage
            window.addEventListener('confirmed-unblock-admin-modal', function(event) {
                if (event.detail && event.detail.adminId) {
                    const form = document.getElementById(`toggle-block-form-${event.detail.adminId}`);
                    if (form) {
                        form.submit();
                    }
                }
            });
        });
    </script>
</x-app-layout>