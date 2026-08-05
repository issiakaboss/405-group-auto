<x-guest-layout>
    <div class="max-w-6xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <p class="text-xs uppercase tracking-[0.24em] text-amber-700 font-semibold mb-3">About & Contact</p>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">405 Group Auto</h1>
                <p class="text-sm text-gray-600 leading-7 mb-5">
                    We help U.S.-based buyers discover premium inventory, request custom vehicle matches, and submit purchase inquiries directly to the dealership team.
                </p>
                <div class="grid gap-4 text-sm text-gray-700">
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-semibold">Address</p>
                        <p>1230 Auto Drive, Suite 400, Houston, TX 77002</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-semibold">Hours</p>
                        <p>Mon–Sat: 9:00 AM – 7:00 PM</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-semibold">Phone</p>
                        <p>(555) 555-1234</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-semibold">Email</p>
                        <p>hello@405groupauto.com</p>
                    </div>
                </div>
                <div class="mt-6">
                    <iframe class="w-full rounded-xl border-0 h-72" src="https://www.google.com/maps?q=Houston%20TX&z=12&output=embed" loading="lazy" allowfullscreen></iframe>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Send a Message</h2>
                <form action="{{ route('about.contact') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="5" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-[#0F172A] text-white rounded-xl font-semibold text-sm hover:bg-gray-800 transition">
                        Send Message
                    </button>
                </form>
            </section>
        </div>

          <!-- SECTION TEXTE INTRODUCTIF -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to 405 Group Auto - Your Ultimate Luxury Automotive Destination</h2>
            <p class="text-gray-500 text-sm leading-relaxed">
                405 Group Auto is a premium e-commerce platform designed for luxury vehicle enthusiasts. We offer a curated selection of the world's most prestigious brands. Our complete shopping experience features detailed information for each vehicle, seamless contact tracking, and custom import structures from the USA directly to Africa.
            </p>
        </div>



    <!-- SECTION WHY CHOOSE US -->
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Why Choose 405 Group Auto?</h3>
            <p class="text-gray-400 text-xs">We provide premium automotive experiences with unmatched service and quality</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-24">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.76-.435.932 0l2.309 4.671 5.127.745c.478.07.667.653.322.988l-3.715 3.62 1.13 5.086c.106.478-.396.84-.811.614L12 16.732l-4.507 2.372c-.415.226-.917-.136-.811-.614l1.13-5.087-3.715-3.62c-.345-.336-.156-.918.322-.988l5.128-.745 2.308-4.671Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Premium Quality</h4>
                <p class="text-gray-400 text-xs">Only the finest vehicles from trusted brands worldwide.</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751A11.956 11.956 0 0 1 12 2.714Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Secured Logistics</h4>
                <p class="text-gray-400 text-xs">Full tracking from US ports straight to your local destination.</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9Zm0-3.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Expert Support</h4>
                <p class="text-gray-400 text-xs">24/7 dedicated support team covering two continents.</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-3.75c-.621 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Transatlantic Deals</h4>
                <p class="text-gray-400 text-xs">Direct auction access in the USA with optimized localized pricing.</p>
            </div>
        </div>
    </div>
    </div>
</x-guest-layout>