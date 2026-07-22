<x-guest-layout>

    <div class="py-16 bg-gray-50/50 min-h-[80vh]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">

                <div class="md:col-span-2 space-y-6 md:pr-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Get in touch</span>
                        <h2 class="text-xl font-black text-gray-900 mt-1 uppercase tracking-tight">Contact Us</h2>
                    </div>

                    <div class="space-y-4 text-xs font-medium text-gray-600">
                        <div class="flex items-start space-x-3">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Ouagadougou, Burkina Faso</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.435-5.161-3.772-6.596-6.596l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.75Z" />
                            </svg>
                            <span>(+1) 405-417-3665</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span>405autogroup@gmail.com</span>
                        </div>
                    </div>
                </div>

                <form action="#" method="POST" class="md:col-span-3 space-y-4 text-xs font-semibold">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" class="w-full p-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-900 focus:ring-0 transition" placeholder="John Doe" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" class="w-full p-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-900 focus:ring-0 transition" placeholder="john@example.com" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="4" class="w-full p-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-900 focus:ring-0 transition font-normal" placeholder="Describe the vehicle specification or service you need..." required></textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-gray-900 text-white rounded-xl uppercase tracking-wider hover:bg-gray-800 transition shadow-sm">
                        Send Message
                    </button>
                </form>

            </div>
        </div>
    </div>

</x-guest-layout>