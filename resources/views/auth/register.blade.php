<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared.title-meta', ['title' => "Register"])
    @include('layouts.shared.head-css')
</head>

<body>

<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">
    <div class="h-screen w-screen flex justify-center items-center">
        <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
            <div class="card overflow-hidden sm:rounded-md rounded-none">
                <div class="p-6">
                    <a href="{{ route('home') }}" class="block mb-8">
                        <img class="h-6 block dark:hidden" src="/images/Black Retro Minimalist Vegan Cafe Logo.png" alt="">
                        <img class="h-6 hidden dark:block" src="/images/Black Retro Minimalist Vegan Cafe Logo.png" alt="">
                    </a>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="fullName">Full Name</label>
                            <input id="fullName" name="name" class="form-input" type="text" placeholder="Enter your Name" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                            <input id="email" name="email" class="form-input" type="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password">Password</label>
                            <input id="password" name="password" class="form-input" type="password" placeholder="Enter your password" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" class="form-input" type="password" placeholder="Confirm your password" required>
                        </div>

                        <div class="flex justify-center mb-6">
                            <button type="submit" class="btn w-full text-white bg-primary">Register</button>
                        </div>
                    </form>

                    <p class="text-gray-500 dark:text-gray-400 text-center">Already have an account?<a href="{{ route('login') }}" class="text-primary ms-1"><b>Log In</b></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
