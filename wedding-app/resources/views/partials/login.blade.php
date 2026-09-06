<div
    x-data="{
        loginModal: false,
        authMode: 'login',

        openLogin() {
            this.authMode = 'login';
            this.loginModal = true;
            document.body.classList.add('overflow-hidden');
        },

        openRegister() {
            this.authMode = 'register';
            this.loginModal = true;
            document.body.classList.add('overflow-hidden');
        },

        closeModal() {
            this.loginModal = false;
            document.body.classList.remove('overflow-hidden');
        }
    }"
    x-on:open-login-modal.window="openLogin()"
    x-on:open-register-modal.window="openRegister()"
    x-on:keydown.escape.window="closeModal()"
    x-cloak
>

    {{-- =========================================================
         MODAL BACKDROP
    ========================================================== --}}
    <div
        x-show="loginModal"
        x-cloak

        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"

        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"

        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 p-2 backdrop-blur-sm sm:p-4"
        role="dialog"
        aria-modal="true"
    >

        {{-- =====================================================
             OVERLAY CLICK
        ====================================================== --}}
        <div
            class="absolute inset-0"
            @click="closeModal()"
        ></div>


        {{-- =====================================================
             MODAL CONTAINER
        ====================================================== --}}
        <div
            x-show="loginModal"

            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"

            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"

            class="
                relative z-10
                flex w-full
                max-w-md
                flex-col
                overflow-hidden
                rounded-2xl
                bg-white
                shadow-2xl
                sm:rounded-3xl
            "

            style="max-height: calc(100dvh - 1rem);"
        >

            {{-- =================================================
                 LOGIN
            ================================================== --}}
            <div
                x-show="authMode === 'login'"

                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"

                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"

                class="flex min-h-0 flex-col"
            >

                {{-- =================================================
                     LOGIN HEADER
                ================================================== --}}
                <div
                    class="
                        relative
                        shrink-0
                        bg-gradient-to-br
                        from-rose-500
                        to-rose-600
                        px-5
                        py-6
                        text-white
                        sm:px-6
                        sm:py-8
                    "
                >

                    {{-- Close Button --}}
                    <button
                        type="button"
                        @click="closeModal()"

                        class="
                            absolute
                            right-3
                            top-3
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-full
                            bg-white/10
                            transition
                            hover:bg-white/20
                            active:scale-95
                            sm:right-4
                            sm:top-4
                        "

                        aria-label="Tutup"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
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


                    {{-- Login Icon --}}
                    <div
                        class="
                            mb-3
                            flex
                            h-12
                            w-12
                            items-center
                            justify-center
                            rounded-2xl
                            bg-white/15
                            sm:mb-4
                            sm:h-14
                            sm:w-14
                        "
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 sm:h-7 sm:w-7"
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


                    <h2
                        class="
                            pr-10
                            text-xl
                            font-bold
                            leading-tight
                            sm:text-2xl
                        "
                    >
                        Selamat Datang Kembali
                    </h2>

                    <p class="mt-1 text-xs text-rose-100 sm:text-sm">
                        Masuk ke akun NikahDigital Anda
                    </p>

                </div>


                {{-- =================================================
                     LOGIN BODY
                ================================================== --}}
                <div
                    class="
                        min-h-0
                        flex-1
                        overflow-y-auto
                        px-5
                        py-5
                        sm:px-6
                        sm:py-6
                    "
                >

                    {{-- Login Validation Errors --}}
                    @if ($errors->any() && old('_auth_form') !== 'register')

                        <div
                            class="
                                mb-5
                                rounded-xl
                                border
                                border-red-200
                                bg-red-50
                                p-3
                                sm:p-4
                            "
                        >

                            <div class="flex gap-3">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.48 0z"
                                    />
                                </svg>

                                <div class="min-w-0">

                                    <p class="text-sm font-semibold text-red-700">
                                        Login gagal
                                    </p>

                                    <ul class="mt-1 space-y-1 text-xs text-red-600">

                                        @foreach ($errors->all() as $error)
                                            <li class="break-words">
                                                {{ $error }}
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         LOGIN FORM
                    ================================================== --}}
                    <form
                        action="{{ route('login.process') }}"
                        method="POST"
                        class="space-y-4 sm:space-y-5"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="_auth_form"
                            value="login"
                        >


                        {{-- =================================================
                             EMAIL
                        ================================================== --}}
                        <div>

                            <label
                                for="login-email"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Email
                            </label>

                            <div class="relative">

                                {{-- Email Icon --}}
                                <div
                                    class="
                                        pointer-events-none
                                        absolute
                                        inset-y-0
                                        left-0
                                        flex
                                        items-center
                                        pl-3.5
                                        sm:pl-4
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.5 7l8.5 6 8.5-6"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="login-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="nama@email.com"

                                    class="
                                        block
                                        w-full
                                        min-w-0
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        py-3
                                        pl-11
                                        pr-4
                                        text-sm
                                        text-slate-800
                                        outline-none
                                        transition
                                        placeholder:text-slate-400
                                        focus:border-rose-400
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-rose-100
                                    "
                                >

                            </div>

                        </div>


                        {{-- =================================================
                             PASSWORD
                        ================================================== --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between gap-3">

                                <label
                                    for="login-password"
                                    class="block text-sm font-semibold text-slate-700"
                                >
                                    Password
                                </label>

                                <span
                                    class="shrink-0 text-xs font-medium text-slate-400"
                                >
                                    Lupa password?
                                </span>

                            </div>


                            <div
                                x-data="{ showPassword: false }"
                                class="relative"
                            >

                                {{-- Password Icon --}}
                                <div
                                    class="
                                        pointer-events-none
                                        absolute
                                        inset-y-0
                                        left-0
                                        flex
                                        items-center
                                        pl-3.5
                                        sm:pl-4
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="5"
                                            y="10"
                                            width="14"
                                            height="10"
                                            rx="2"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 10V7a4 4 0 018 0v3"
                                        />
                                    </svg>

                                </div>


                                {{-- Password Input --}}
                                <input
                                    id="login-password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"

                                    class="
                                        block
                                        w-full
                                        min-w-0
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        py-3
                                        pl-11
                                        pr-11
                                        text-sm
                                        text-slate-800
                                        outline-none
                                        transition
                                        placeholder:text-slate-400
                                        focus:border-rose-400
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-rose-100
                                    "
                                >


                                {{-- Password Toggle --}}
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"

                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        flex
                                        items-center
                                        pr-3.5
                                        text-slate-400
                                        transition
                                        hover:text-slate-600
                                        active:scale-95
                                        sm:pr-4
                                    "

                                    :aria-label="
                                        showPassword
                                            ? 'Sembunyikan password'
                                            : 'Tampilkan password'
                                    "
                                >

                                    {{-- Eye --}}
                                    <svg
                                        x-show="!showPassword"
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
                                            d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>


                                    {{-- Eye Off --}}
                                    <svg
                                        x-show="showPassword"
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
                                            d="M3 3l18 18"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.6 5.2A10.7 10.7 0 0112 5c6 0 9.5 7 9.5 7a16.7 16.7 0 01-3.2 3.9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.7 6.7C4.1 8.4 2.5 12 2.5 12s3.5 7 9.5 7c1.4 0 2.7-.3 3.8-.8"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                             REMEMBER ME
                        ================================================== --}}
                        <label
                            class="
                                flex
                                cursor-pointer
                                items-center
                                gap-2
                            "
                        >

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}

                                class="
                                    h-4
                                    w-4
                                    shrink-0
                                    rounded
                                    border-slate-300
                                    text-rose-500
                                    focus:ring-rose-400
                                "
                            >

                            <span class="text-sm text-slate-600">
                                Ingat saya
                            </span>

                        </label>


                        {{-- =================================================
                             LOGIN BUTTON
                        ================================================== --}}
                        <button
                            type="submit"

                            class="
                                w-full
                                rounded-xl
                                bg-rose-500
                                px-5
                                py-3.5
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-rose-500/20
                                transition
                                hover:bg-rose-600
                                hover:shadow-xl
                                active:scale-[0.99]
                            "
                        >
                            Masuk ke Akun
                        </button>

                    </form>


                    {{-- =================================================
                         REGISTER SWITCH
                    ================================================== --}}
                    <div
                        class="
                            mt-5
                            border-t
                            border-slate-100
                            pt-5
                            text-center
                            sm:mt-6
                        "
                    >

                        <p class="text-sm text-slate-500">

                            Belum punya akun?

                            <button
                                type="button"
                                @click="openRegister()"
                                class="
                                    font-semibold
                                    text-rose-500
                                    transition
                                    hover:text-rose-600
                                "
                            >
                                Daftar sekarang
                            </button>

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 REGISTER
            ================================================== --}}
            <div
                x-show="authMode === 'register'"

                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"

                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"

                class="flex min-h-0 flex-col"
            >

                {{-- =================================================
                     REGISTER HEADER
                ================================================== --}}
                <div
                    class="
                        relative
                        shrink-0
                        bg-gradient-to-br
                        from-rose-500
                        to-rose-600
                        px-5
                        py-6
                        text-white
                        sm:px-6
                        sm:py-7
                    "
                >

                    {{-- Close --}}
                    <button
                        type="button"
                        @click="closeModal()"

                        class="
                            absolute
                            right-3
                            top-3
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-full
                            bg-white/10
                            transition
                            hover:bg-white/20
                            active:scale-95
                            sm:right-4
                            sm:top-4
                        "

                        aria-label="Tutup"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
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


                    {{-- Register Icon --}}
                    <div
                        class="
                            mb-3
                            flex
                            h-12
                            w-12
                            items-center
                            justify-center
                            rounded-2xl
                            bg-white/15
                            sm:mb-4
                            sm:h-14
                            sm:w-14
                        "
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 sm:h-7 sm:w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                            />

                            <circle
                                cx="9"
                                cy="7"
                                r="4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8v6M22 11h-6"
                            />
                        </svg>

                    </div>


                    <h2
                        class="
                            pr-10
                            text-xl
                            font-bold
                            leading-tight
                            sm:text-2xl
                        "
                    >
                        Buat Akun Baru
                    </h2>

                    <p class="mt-1 text-xs text-rose-100 sm:text-sm">
                        Daftar dan mulai buat undangan digital Anda
                    </p>

                </div>


                {{-- =================================================
                     REGISTER BODY
                ================================================== --}}
                <div
                    class="
                        min-h-0
                        flex-1
                        overflow-y-auto
                        px-5
                        py-5
                        sm:px-6
                        sm:py-6
                    "
                >

                    {{-- Register Validation Errors --}}
                    @if ($errors->any() && old('_auth_form') === 'register')

                        <div
                            class="
                                mb-5
                                rounded-xl
                                border
                                border-red-200
                                bg-red-50
                                p-3
                                sm:p-4
                            "
                        >

                            <div class="flex gap-3">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.48 0z"
                                    />
                                </svg>

                                <div class="min-w-0">

                                    <p class="text-sm font-semibold text-red-700">
                                        Registrasi gagal
                                    </p>

                                    <ul class="mt-1 space-y-1 text-xs text-red-600">

                                        @foreach ($errors->all() as $error)
                                            <li class="break-words">
                                                {{ $error }}
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         REGISTER FORM
                    ================================================== --}}
                    <form
                        action="{{ route('register.process') }}"
                        method="POST"
                        class="space-y-4"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="_auth_form"
                            value="register"
                        >


                        {{-- =================================================
                             NAME
                        ================================================== --}}
                        <div>

                            <label
                                for="register-name"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                id="register-name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                placeholder="Nama lengkap Anda"

                                class="
                                    block
                                    w-full
                                    min-w-0
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    py-3
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    transition
                                    placeholder:text-slate-400
                                    focus:border-rose-400
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-rose-100
                                "
                            >

                        </div>


                        {{-- =================================================
                             PHONE
                        ================================================== --}}
                        <div>

                            <label
                                for="register-phone"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Nomor WhatsApp

                                <span class="font-normal text-slate-400">
                                    (opsional)
                                </span>
                            </label>

                            <input
                                id="register-phone"
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                placeholder="08xxxxxxxxxx"

                                class="
                                    block
                                    w-full
                                    min-w-0
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    py-3
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    transition
                                    placeholder:text-slate-400
                                    focus:border-rose-400
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-rose-100
                                "
                            >

                        </div>


                        {{-- =================================================
                             EMAIL
                        ================================================== --}}
                        <div>

                            <label
                                for="register-email"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Email
                            </label>

                            <input
                                id="register-email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="nama@email.com"

                                class="
                                    block
                                    w-full
                                    min-w-0
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    py-3
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    transition
                                    placeholder:text-slate-400
                                    focus:border-rose-400
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-rose-100
                                "
                            >

                        </div>


                        {{-- =================================================
                             PASSWORD
                        ================================================== --}}
                        <div>

                            <label
                                for="register-password"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Password
                            </label>

                            <div
                                x-data="{ showPassword: false }"
                                class="relative"
                            >

                                <input
                                    id="register-password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Minimal 8 karakter"

                                    class="
                                        block
                                        w-full
                                        min-w-0
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        py-3
                                        pl-4
                                        pr-11
                                        text-sm
                                        text-slate-800
                                        outline-none
                                        transition
                                        placeholder:text-slate-400
                                        focus:border-rose-400
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-rose-100
                                    "
                                >


                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"

                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        flex
                                        items-center
                                        pr-3.5
                                        text-slate-400
                                        transition
                                        hover:text-slate-600
                                        active:scale-95
                                    "

                                    :aria-label="
                                        showPassword
                                            ? 'Sembunyikan password'
                                            : 'Tampilkan password'
                                    "
                                >

                                    <svg
                                        x-show="!showPassword"
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
                                            d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>


                                    <svg
                                        x-show="showPassword"
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
                                            d="M3 3l18 18"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.6 5.2A10.7 10.7 0 0112 5c6 0 9.5 7 9.5 7a16.7 16.7 0 01-3.2 3.9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.7 6.7C4.1 8.4 2.5 12 2.5 12s3.5 7 9.5 7c1.4 0 2.7-.3 3.8-.8"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                             CONFIRM PASSWORD
                        ================================================== --}}
                        <div>

                            <label
                                for="register-password-confirmation"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Konfirmasi Password
                            </label>

                            <div
                                x-data="{ showPassword: false }"
                                class="relative"
                            >

                                <input
                                    id="register-password-confirmation"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Ulangi password"

                                    class="
                                        block
                                        w-full
                                        min-w-0
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        py-3
                                        pl-4
                                        pr-11
                                        text-sm
                                        text-slate-800
                                        outline-none
                                        transition
                                        placeholder:text-slate-400
                                        focus:border-rose-400
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-rose-100
                                    "
                                >


                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"

                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        flex
                                        items-center
                                        pr-3.5
                                        text-slate-400
                                        transition
                                        hover:text-slate-600
                                        active:scale-95
                                    "

                                    :aria-label="
                                        showPassword
                                            ? 'Sembunyikan password'
                                            : 'Tampilkan password'
                                    "
                                >

                                    <svg
                                        x-show="!showPassword"
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
                                            d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>


                                    <svg
                                        x-show="showPassword"
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
                                            d="M3 3l18 18"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.6 5.2A10.7 10.7 0 0112 5c6 0 9.5 7 9.5 7a16.7 16.7 0 01-3.2 3.9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.7 6.7C4.1 8.4 2.5 12 2.5 12s3.5 7 9.5 7c1.4 0 2.7-.3 3.8-.8"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                             REGISTER BUTTON
                        ================================================== --}}
                        <button
                            type="submit"

                            class="
                                w-full
                                rounded-xl
                                bg-rose-500
                                px-5
                                py-3.5
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-rose-500/20
                                transition
                                hover:bg-rose-600
                                hover:shadow-xl
                                active:scale-[0.99]
                            "
                        >
                            Buat Akun
                        </button>

                    </form>


                    {{-- =================================================
                         BACK TO LOGIN
                    ================================================== --}}
                    <div
                        class="
                            mt-5
                            border-t
                            border-slate-100
                            pt-5
                            text-center
                            sm:mt-6
                        "
                    >

                        <p class="text-sm text-slate-500">

                            Sudah punya akun?

                            <button
                                type="button"
                                @click="openLogin()"

                                class="
                                    font-semibold
                                    text-rose-500
                                    transition
                                    hover:text-rose-600
                                "
                            >
                                Masuk sekarang
                            </button>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
