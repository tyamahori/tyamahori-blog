@extends('stisla.auth.layouts.login-master')

@section('css-libraries')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
@stop

@section('form-area')
  <h4 class="text-dark font-weight-normal">Welcome back!</h4>
  <p class="text-muted">Here is Login Page</p>
  <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
    @csrf
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
      <div class="invalid-feedback">
        Please fill in your email
      </div>
      <strong>{{ $errors->first('email') }}</strong>
    </div>

    <div class="form-group">
      <div class="d-block">
        <label for="password" class="control-label">Password</label>
      </div>
      <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
      <div class="invalid-feedback">
        please fill in your password
      </div>
    </div>

    <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
        <label class="custom-control-label" for="remember-me">Remember Me</label>
      </div>
    </div>

    <div class="form-group text-right">
      <a href="" class="float-left mt-3">
        Forgot Password?
      </a>
      <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
        Login
      </button>
    </div>

    <div class="mt-5 text-center">
      Don't have an account? <a href="">Create new one</a>
    </div>
  </form>
@stop

@section('side-image')
  <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('/stisla/assets/img/unsplash/login-bg.jpg') }}">
    <div class="absolute-bottom-left index-2">
      <div class="text-light p-5 pb-2">
        <div class="mb-5 pb-3">
          <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
          <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
        </div>
        Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
      </div>
    </div>
  </div>
@stop
