@extends('layouts.app-home')

@section('styles')
<link rel="stylesheet" href="home/styles/pages/account.css" />
@endsection

@section('content')
    <main>
    <x-guest-layout>
        <x-authentication-card>
            <x-validation-errors class="mb-4" />

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <div class="account-container">
                <div class="account">
                    <div class="form-account">
                        <div class="login-container" id="login">
                            <form method="POST" action="{{ route('login') }}">
                                <div class="top">
                                    <span>Don't have account? <a href="#" onclick="create()">Sign Up</a> </span>
                                    <header class="header-ac">Login</header>
                                </div>
                                @csrf

                                <div>
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                </div>

                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" />
                                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                    @endif

                                    <x-button class="ms-4" style="background-color: var(--primary-color); color: var(--light-color);">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                        <div class="create-container" id="create">
                            <form method="POST" action="{{ route('register') }}">
                                <div class="top">
                                    <span>Have an account? <a href="#" onclick="login()">Sign In</a> </span>
                                    <header class="header-ac">Sign Up</header>
                                </div>
                                @csrf

                                <div class="two-form">
                                    <div>
                                        <x-label for="FirstName" value="{{ __('FirstName') }}" />
                                        <x-input id="FirstName" class="block mt-1 w-full" type="text" name="FirstName" :value="old('FirstName')" required autofocus autocomplete="FirstName" />
                                    </div>

                                    <div>
                                        <x-label for="LastName" value="{{ __('LastName') }}" />
                                        <x-input id="LastName" class="block mt-1 w-full" type="text" name="LastName" :value="old('LastName')" required autofocus autocomplete="LastName" />
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                                @endif

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <x-button class="ms-4" style="background-color: var(--primary-color); color: var(--light-color);">
                                        {{ __('Register') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="pictures/display-products/children-model.jpg" style="width: 100%;" alt="">
                </div>
            </div>
        </x-authentication-card>
    </x-guest-layout>
    </main>

@endsection

@section('scripts')
<script src="home/scripts/account.js"></script>
@endsection