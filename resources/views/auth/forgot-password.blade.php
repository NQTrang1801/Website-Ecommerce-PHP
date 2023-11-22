<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('home.frame-css')
    <link rel="stylesheet" href="home/styles/pages/account.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    @include('home.header')
    <main>
        <x-guest-layout>
            <x-authentication-card>

                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

                <x-validation-errors class="mb-4" />
                <div class="account-container">
                    <div style="margin: 0px 200px;">
                        <div class="mb-4 text-sm text-gray-600" style="margin-top: 100px;">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="block">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button style="background-color: var(--primary-color); color: var(--light-color);">
                                    {{ __('Email Password Reset Link') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <img src="pictures/display-products/children-model.jpg" style="width: 100%;" alt="">
                    </div>
                </div>
            </x-authentication-card>
        </x-guest-layout>
    </main>

    <script type="module" src="home/scripts/index.js"></script>
    <script src="home/scripts/account.js"></script>
</body>

</html>