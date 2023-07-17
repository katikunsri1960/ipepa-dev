@extends('auth.layout')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div class="p-h-xl">
        <div class="m-t-xl">
            <!-- <h1 class="logo-name" src="/unsri-logo-50.png">UNSRI</h1> -->
            <img src="/unsri_icon.png" alt=""><br/><br/>
        </div>
        <h3>Welcome to Dashboard Feeder<br/>
            Universitas Sriwijaya</h3>
        <p>Login in. To see it in action.</p>
        <p class="text-danger">{{session('error')}}</p>

        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input id="username" type="name" class="form-control @error('username') is-invalid @enderror"
                    name="username" required autocomplete="username"
                    placeholder="Username">

                @error('username')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                <small>{{ __('Forgot Your Password?') }}</small>
            </a>
            @endif
        </form>
    </div>
</div>


@endsection
