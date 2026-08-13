@extends('admin.layout') {{-- Change to 'layout' if your layout file is resources/views/layout.blade.php --}}

@section('admin-dashboard-profile') {{-- Matches your @yield('admin-dashboard-profile') tag --}}
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="font-weight-bold">Profile Settings</h3>
                <p class="text-muted mb-0">Manage your account credentials, avatar, and personal details.</p>
            </div>
        </div>

        <div class="row">
            <!-- Profile Information Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm border-danger">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection