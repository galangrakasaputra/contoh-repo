<header
    x-data="{
        open: false,
        userMenu: false
    }"
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-rose-100"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex h-20 items-center justify-between">

            {{-- =====================================================
                LOGO
            ====================================================== --}}
            <a
                href="{{ url('/') }}"
                class="flex items-center gap-3"
            >
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-500 text-white shadow-lg shadow-rose-500/20">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21s-7-4.35-7-10.2A4.8 4.8 0 0110 6.1c.8 0 1.55.2 2.2.58A4.8 4.8 0 0114.4 6.1 4.8 4.8 0 0119 10.8C19 16.65 12 21 12 21z"
                        />
                    </svg>
                </div>

                <span class="text-xl font-bold text-slate-800">
                    Nikah<span class="text-rose-500">Digital</span>
                </span>
            </a>


            {{-- =====================================================
                DESKTOP NAVIGATION
            ====================================================== --}}
            <nav class="hidden md:flex items-center gap-8">

                <a
                    href="{{ url('/') }}"
                    class="text-sm font-medium text-slate-600 hover:text-rose-500 transition"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('templates.index') }}"
                    class="text-sm font-medium text-slate-600 hover:text-rose-500 transition"
                >
                    Template
                </a>

            </nav>


            {{-- =====================================================
                DESKTOP ACTIONS
            ====================================================== --}}
            <div class="hidden md:flex items-center gap-3">

                {{-- =================================================
                    JIKA BELUM LOGIN
                ================================================== --}}
                @guest

                    {{-- Masuk --}}
                    <button
                        type="button"
                        @click="$dispatch('open-login-modal')"
                        class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-500"
                    >
                        Masuk
                    </button>

                @endguest


                {{-- =================================================
                    JIKA SUDAH LOGIN
                ================================================== --}}
                @auth

                    {{-- User Menu --}}
                    <div class="relative">

                        <button
                            type="button"
                            @click="userMenu = !userMenu"
                            @click.outside="userMenu = false"
                            class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-rose-50"
                        >

                            {{-- Avatar --}}
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-rose-100 text-sm font-bold text-rose-500">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            {{-- Nama --}}
                            <span class="max-w-[140px] truncate">
                                {{ auth()->user()->name }}
                            </span>

                            {{-- Arrow --}}
                            <svg
                                class="h-4 w-4 transition-transform"
                                :class="{ 'rotate-180': userMenu }"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>


                        {{-- Dropdown --}}
                        <div
                            x-show="userMenu"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-xl shadow-slate-900/10"
                        >

                            {{-- User Info --}}
                            <div class="border-b border-slate-100 px-4 py-3">

                                <p class="text-sm font-bold text-slate-800 truncate">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500 truncate">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>


                            {{-- Akun --}}
                            <a
                                href="#"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 transition hover:bg-rose-50 hover:text-rose-500"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                                    />
                                </svg>

                                Akun Saya
                            </a>

                            {{-- Undangan Saya --}}
                            <a
                                href="{{ route('weddings.index') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 transition hover:bg-rose-50 hover:text-rose-500"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4M3 11h18" />
                                </svg>
                                Undangan Saya
                            </a>


                            {{-- Logout --}}
                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-500 transition hover:bg-red-50"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 15l3-3m0 0l-3-3m3 3H3"
                                        />
                                    </svg>

                                    Keluar
                                </button>

                            </form>

                        </div>

                    </div>

                @endauth


                {{-- =================================================
                    PILIH TEMPLATE
                ================================================== --}}
                @guest
                    <button
                        type="button"
                        @click="$dispatch('open-login-modal')"
                        class="rounded-xl bg-rose-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-rose-600"
                    >
                        Pilih Template
                    </button>
                @endguest

                @auth
                    <a
                        href="{{ route('templates.index') }}"
                        class="rounded-xl bg-rose-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-rose-600"
                    >
                        Pilih Template
                    </a>
                @endauth

            </div>


            {{-- =====================================================
                MOBILE BUTTON
            ====================================================== --}}
            <button
                type="button"
                @click="open = !open"
                class="md:hidden flex h-10 w-10 items-center justify-center rounded-xl text-slate-600 hover:bg-rose-50 hover:text-rose-500"
            >

                {{-- Hamburger --}}
                <svg
                    x-show="!open"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                {{-- Close --}}
                <svg
                    x-show="open"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- =========================================================
            MOBILE NAVIGATION
        ========================================================== --}}
        <div
            x-show="open"
            x-cloak
            x-transition
            class="md:hidden border-t border-rose-100 py-4"
        >

            <div class="flex flex-col gap-2">

                {{-- Beranda --}}
                <a
                    href="{{ url('/') }}"
                    @click="open = false"
                    class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-rose-50 hover:text-rose-500"
                >
                    Beranda
                </a>


                {{-- Template --}}
                <a
                    href="{{ route('templates.index') }}"
                    @click="open = false"
                    class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-rose-50 hover:text-rose-500"
                >
                    Template
                </a>


                <div class="mt-2 border-t border-slate-100 pt-3">

                    {{-- =================================================
                        MOBILE BELUM LOGIN
                    ================================================== --}}
                    @guest

                        <button
                            type="button"
                            @click="open = false; $dispatch('open-login-modal')"
                            class="w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 hover:bg-rose-50 hover:text-rose-500"
                        >
                            Masuk
                        </button>

                    @endguest


                    {{-- =================================================
                        MOBILE SUDAH LOGIN
                    ================================================== --}}
                    @auth

                        {{-- User Info --}}
                        <div class="mb-2 flex items-center gap-3 rounded-xl bg-rose-50 px-4 py-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-rose-100 text-sm font-bold text-rose-500">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="text-sm font-bold text-slate-800 truncate">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="text-xs text-slate-500 truncate">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>

                        </div>


                        {{-- Akun Saya --}}
                        <a
                            href="#"
                            @click="open = false"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-rose-50 hover:text-rose-500"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                                />
                            </svg>

                            Akun Saya
                        </a>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="mt-1 flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-500 hover:bg-red-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 15l3-3m0 0l-3-3m3 3H3"
                                    />
                                </svg>

                                Keluar
                            </button>

                        </form>

                    @endauth


                    {{-- Pilih Template --}}
                    <button
                        type="button"
                        @click="open = false; $dispatch('open-login-modal')"
                        class="mt-2 w-full rounded-xl bg-rose-500 px-4 py-3 text-center text-sm font-bold text-white shadow-lg shadow-rose-500/20"
                    >
                        Pilih Template
                    </button>

                </div>

            </div>

        </div>

    </div>
</header>
