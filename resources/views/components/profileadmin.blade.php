@extends('layouts.admin')

@section('content')
    <!-- Hero Section -->
    <div class="bg-image" style="background-image: url('{{ asset('assets/media/photos/photo10@2x.jpg') }}');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <h1 class="h2 text-white mb-0">Edit Account</h1>
                <h2 class="h4 fw-normal text-white-75">{{ $admin->username }}</h2>
                <a class="btn btn-alt-secondary mt-3" href="/">
                    <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Profile
                </a>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content content-boxed">
        {{-- Flash Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- User Profile Form -->
        <div class="block block-rounded mt-4">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Profile</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('profileadmin.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Informasi akun Anda. Username akan terlihat secara publik.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username"
                                       name="username" placeholder="Enter your username.."
                                       value="{{ old('username', $admin->username) }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email"
                                       name="email" placeholder="Enter your email.."
                                       value="{{ old('email', $admin->email) }}">
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password Form -->
        <div class="block block-rounded mt-4">
            <div class="block-header block-header-default">
                <h3 class="block-title">Change Password</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('profileadmin.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Ubah password Anda untuk menjaga keamanan akun.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password"
                                       name="current_password" placeholder="Enter current password..">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password"
                                       name="new_password" placeholder="Enter new password..">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                       name="new_password_confirmation" placeholder="Confirm new password..">
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Update Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->
    </div>
@endsection
