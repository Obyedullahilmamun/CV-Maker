@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="py-4">
        <div class="container">
            <!-- Update Profile Info -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <section>
                        <header class="mb-4">
                            <h2 class="h4">Profile Information</h2>
                            <p class="text-muted small">Update your account's profile information and email address.</p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" name="name" type="text" class="form-control"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                @if (session('status') === 'profile-updated')
                                    <span class="text-success small">Saved.</span>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <section>
                        <header class="mb-4">
                            <h2 class="h4">Update Password</h2>
                            <p class="text-muted small">Ensure your account is using a long, random password to stay secure.
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="update_password_current_password" class="form-label">Current Password</label>
                                <input id="update_password_current_password" name="current_password" type="password"
                                    class="form-control" autocomplete="current-password">
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password" class="form-label">New Password</label>
                                <input id="update_password_password" name="password" type="password" class="form-control"
                                    autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password_confirmation" class="form-label">Confirm
                                    Password</label>
                                <input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="form-control" autocomplete="new-password">
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                @if (session('status') === 'password-updated')
                                    <span class="text-success small">Saved.</span>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <section>
                        <header class="mb-4">
                            <h2 class="h4 text-danger">Delete Account</h2>
                            <p class="text-muted small">Once your account is deleted, all of its resources and data will be
                                permanently deleted.</p>
                        </header>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" type="password" class="form-control"
                                    placeholder="Password">
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" onclick="window.history.back();"
                                    class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
