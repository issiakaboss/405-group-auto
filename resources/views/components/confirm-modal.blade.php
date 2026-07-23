@props([
    'name' => 'confirm-modal',
    'title' => 'Are you sure?',
    'message' => 'This action cannot be undone.',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'type' => 'danger' // 'danger' ou 'warning'
])

<div x-data="{ open: false, payload: null }"
     x-on:open-modal-{{ $name }}.window="open = true; payload = $event.detail"
     x-on:close-modal-{{ $name }}.window="open = false; payload = null"
     x-show="open" 
     x-cloak 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.escape.window="open = false"
     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    
    <div @click.away="open = false" 
         class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 space-y-4 text-center">
        
        <!-- Icone -->
        @if($type === 'danger')
            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
        @else
            <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008s0 0 0 0z" />
                </svg>
            </div>
        @endif

        <div class="space-y-1">
            <h3 class="font-bold text-gray-900 text-base">{{ $title }}</h3>
            <p class="text-xs text-gray-500">{{ $message }}</p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="button" 
                    @click="open = false" 
                    class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs rounded-xl transition">
                {{ $cancelText }}
            </button>
            
            <button type="button" 
                    @click="$dispatch('confirmed-{{ $name }}', payload); open = false;" 
                    class="flex-1 py-2.5 {{ $type === 'danger' ? 'bg-red-600 hover:bg-red-700' : 'bg-amber-600 hover:bg-amber-700' }} text-white font-semibold text-xs rounded-xl shadow-sm transition">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>