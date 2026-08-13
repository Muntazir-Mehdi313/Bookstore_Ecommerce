<section>
    <header class="mb-4">
        <h4 class="card-title card-title-dash mb-1">Profile Information</h4>
        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information, photo, and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('patch')

        <!-- Profile Photo Field -->
        <div class="form-group mb-4">
            <label class="fw-semibold mb-2 d-block">Profile Photo</label>
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-circle border" style="width: 75px; height: 75px; object-fit: cover;">
                <div class="flex-grow-1">
                    <input type="file" id="profilepic" name="profilepic" accept="image/*" class="form-control">
                    <small class="text-muted mt-1 d-block">Allowed formats: JPG, PNG, WEBP (Max size: 2MB)</small>
                </div>
            </div>
            @error('profilepic')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Name Field -->
        <div class="form-group mb-3">
            <label for="name" class="fw-semibold mb-1">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group mb-4">
            <label for="email" class="fw-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-underline small">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2 small p-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary text-white">Save Changes</button>

            @if (session('status') === 'profile-updated')
                <span 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-success small fw-semibold"
                >
                    Saved successfully!
                </span>
            @endif
        </div>
    </form>
</section>