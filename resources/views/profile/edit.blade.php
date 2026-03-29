@extends('layouts.user')

@section('content')

<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            {{ __('messages.profile_settings') }}
        </h2>

        <!-- Update Profile -->
        <div class="p-6 bg-white shadow rounded-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="p-6 bg-white shadow rounded-2xl">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="p-6 bg-white shadow rounded-2xl">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>

@endsection