<x-guest-layout>
    <div class="bg-gray-50/50 py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
           <div class="flex justify-center">
                <img src="{{ asset('images/logo.jpeg') }}"
                    alt="405 Auto Group Logo"
                    class="h-24 sm:h-32 md:h-36 w-auto object-contain drop-shadow-sm">
            </div>
            {{-- SECTION HÉRO / INTRODUCTION --}}
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/60">
                    {{ __('public/about.hero_badge') }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ __('public/about.hero_title') }}
                </h1>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ __('public/about.hero_description') }}
                </p>
            </div>

            {{-- SECTION CONTACT & FORMULAIRE --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- COLONNE GAUCHE : INFOS DE CONTACT & CARTE --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-slate-100/50 p-6 sm:p-8 space-y-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-amber-600 mb-1">{{ __('public/about.get_in_touch') }}</p>
                            <h2 class="text-2xl font-bold text-slate-900">{{ __('public/about.about_contact_title') }}</h2>
                        </div>

                        <div class="space-y-3 text-sm">
                            {{-- Address --}}
                            <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50 border border-slate-100/80 hover:border-slate-200 transition">
                                <div class="p-2.5 rounded-lg bg-white text-slate-900 shadow-sm shrink-0">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ __('public/about.address_label') }}</p>
                                    <p class="text-slate-600 text-xs mt-0.5">{{ __('public/about.address_val') }}</p>
                                </div>
                            </div>

                            {{-- Hours --}}
                            <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50 border border-slate-100/80 hover:border-slate-200 transition">
                                <div class="p-2.5 rounded-lg bg-white text-slate-900 shadow-sm shrink-0">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ __('public/about.hours_label') }}</p>
                                    <p class="text-slate-600 text-xs mt-0.5">{{ __('public/about.hours_val') }}</p>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50 border border-slate-100/80 hover:border-slate-200 transition">
                                <div class="p-2.5 rounded-lg bg-white text-slate-900 shadow-sm shrink-0">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.826-1.47-5.11-3.754-6.58-6.58l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ __('public/about.phone_label') }}</p>
                                    <p class="text-slate-600 text-xs mt-0.5">{{ __('public/about.phone_val') }}</p>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50 border border-slate-100/80 hover:border-slate-200 transition">
                                <div class="p-2.5 rounded-lg bg-white text-slate-900 shadow-sm shrink-0">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ __('public/about.email_label') }}</p>
                                    <a href="mailto:info@405autogroup.com" class="text-amber-600 font-medium hover:underline text-xs mt-0.5 block">info@405autogroup.com</a>
                                </div>
                            </div>
                        </div>

                        {{-- Google Maps --}}
                        <div class="rounded-xl overflow-hidden border border-slate-200 shadow-inner">
                            <iframe class="w-full h-56 border-0" src="https://www.google.com/maps?q=Houston%20TX&z=12&output=embed" loading="lazy" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                {{-- COLONNE DROITE : FORMULAIRE DE CONTACT --}}
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-slate-100/50 p-6 sm:p-8 space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">{{ __('public/about.form_title') }}</h2>
                            <p class="text-xs text-slate-500 mt-1">{{ __('public/about.form_subtitle') }}</p>
                        </div>

                        <form action="{{ route('about.contact') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('public/about.label_name') }}</label>
                                    <input type="text" name="name" placeholder="{{ __('public/about.placeholder_name') }}" required class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-slate-900 text-sm placeholder:text-slate-300">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('public/about.label_email') }}</label>
                                    <input type="email" name="email" placeholder="{{ __('public/about.placeholder_email') }}" required class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-slate-900 text-sm placeholder:text-slate-300">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('public/about.label_phone') }}</label>
                                <input type="text" name="phone" placeholder="{{ __('public/about.placeholder_phone') }}" required class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-slate-900 text-sm placeholder:text-slate-300">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('public/about.label_message') }}</label>
                                <textarea name="message" rows="5" placeholder="{{ __('public/about.placeholder_message') }}" required class="w-full rounded-xl border-slate-200 focus:border-slate-900 focus:ring-slate-900 text-sm placeholder:text-slate-300"></textarea>
                            </div>

                            <button type="submit" class="w-full py-3.5 px-6 bg-slate-950 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg shadow-slate-950/10 flex items-center justify-center gap-2">
                                <span>{{ __('public/about.btn_send') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- SECTION WHY CHOOSE US --}}
            <div class="pt-8 space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <h3 class="text-2xl font-bold text-slate-900">{{ __('public/about.why_title') }}</h3>
                    <p class="text-slate-500 text-xs mt-1">{{ __('public/about.why_subtitle') }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col items-center text-center group">
                        <div class="p-3.5 bg-amber-50 rounded-2xl text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.76-.435.932 0l2.309 4.671 5.127.745c.478.07.667.653.322.988l-3.715 3.62 1.13 5.086c.106.478-.396.84-.811.614L12 16.732l-4.507 2.372c-.415.226-.917-.136-.811-.614l1.13-5.087-3.715-3.62c-.345-.336-.156-.918.322-.988l5.128-.745 2.308-4.671Z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ __('public/about.feature_1_title') }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ __('public/about.feature_1_desc') }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col items-center text-center group">
                        <div class="p-3.5 bg-amber-50 rounded-2xl text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751A11.956 11.956 0 0 1 12 2.714Z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ __('public/about.feature_2_title') }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ __('public/about.feature_2_desc') }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col items-center text-center group">
                        <div class="p-3.5 bg-amber-50 rounded-2xl text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9Zm0-3.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ __('public/about.feature_3_title') }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ __('public/about.feature_3_desc') }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col items-center text-center group">
                        <div class="p-3.5 bg-amber-50 rounded-2xl text-amber-600 mb-4 group-hover:bg-amber-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25H12M3.375 6h9.75M3.375 6a1.125 1.125 0 0 0-1.125 1.125v6.75" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1.5">{{ __('public/about.feature_4_title') }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ __('public/about.feature_4_desc') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>