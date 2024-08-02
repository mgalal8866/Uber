@extends('layout-auth.app')


@section('content')
<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
      <!-- Logo -->
      <div class="app-brand mb-4">
        <a href="index.html" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
              <img src = "{{ asset('logo.svg') }}" width="32" />
          </span>
        </a>
      </div>
      <!-- /Logo -->
      <h3 class="mb-1">Welcome to {{env('APP_NAME','Login')}} 👋</h3>
      <p class="mb-4">Please sign-in to your account and start the adventure</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">{{__('trans.email')}}</label>
          <input
            type="text"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email','admin@admin.com') }}"

            placeholder="Enter your email or username"
            autofocus />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="mb-3 form-password-toggle">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="password">{{__('trans.password')}}</label>
            {{-- <a href="auth-forgot-password-cover.html">
              <small>Forgot Password?</small>
            </a> --}}
          </div>
          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password"
              class="form-control  @error('password') is-invalid @enderror"
              name="password"
                  value="admin"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password"
               />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"  {{ old('remember') ? 'checked' : '' }} />
            <label class="form-check-label" for="remember-me">{{__('trans.rememberme')}} </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
      </form>

      {{-- <p class="text-center">
        <span>New on our platform?</span>
        <a href="auth-register-cover.html">
          <span>Create an account</span>
        </a>
      </p> --}}

      {{-- <div class="divider my-4">
        <div class="divider-text">or</div>
      </div>

      <div class="d-flex justify-content-center">
        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
          <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
        </a>

        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
          <i class="tf-icons fa-brands fa-google fs-5"></i>
        </a>

        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
          <i class="tf-icons fa-brands fa-twitter fs-5"></i>
        </a>
      </div> --}}
    </div>
  </div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
