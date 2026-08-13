@extends('admin.layout')

@section('admin-dashboard-profile')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card mx-auto">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-4">Update Profile</h4>

                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <!-- Current Photo & Upload Button -->
                            <div class="form-group text-center mb-4">
                                <div class="mb-3">
                                    <img src="{{ $user->profile_photo_url }}" alt="Profile Image" class="rounded-circle border" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <label for="profilepic" class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-upload me-1"></i> Choose New Photo
                                </label>
                                <input type="file" id="profilepic" name="profilepic" class="d-none" accept="image/*">
                                @error('profilepic')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="fw-semibold mb-1">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary text-white w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection