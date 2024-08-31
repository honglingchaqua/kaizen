<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared.title-meta', ['title' => "Login"])
    @include('layouts.shared.head-css')
</head>

<body>

<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">
    <div class="h-screen w-screen flex justify-center items-center">
        <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
            <div class="card overflow-hidden sm:rounded-md rounded-none">
                <div class="p-6">
                    <div class="py-2"><img src="/images/Black Retro Minimalist Vegan Cafe Logo.png" alt=""></div>
                                      <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2"
                                   for="LoggingEmailAddress">Alamat Email</label>
                            <input id="LoggingEmailAddress" class="form-input" type="email"
                                   placeholder="Masukkan email Anda" name="email" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2"
                                   for="loggingPassword">Kata Sandi</label>
                            <input id="loggingPassword" class="form-input" type="password"
                                   placeholder="Masukkan kata sandi Anda" name="password" required>
                        </div>

                        <div class="flex justify-center mb-6">
                            <button class="btn w-full text-white bg-primary">Masuk</button>
                        </div>
                    </form>


                    <p class="text-gray-500 dark:text-gray-400 text-center">Belum punya akun? <a
                            href="{{ route('register') }}" class="text-primary ms-1"><b>Daftar</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
