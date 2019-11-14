@extends('layouts.base.master')
@section('content')
  <div class="container">
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <p class="control has-icons-left has-icons-right">
          <input class="input" id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
          <span class="icon is-small is-left">
            <i class="fa fa-envelope"></i>
          </span>
          <span class="icon is-small is-right">
          <i class="fa fa-check"></i>
          </span>
        </p>
      </div>
      <div class="field">
        <p class="control has-icons-left">
          <input id="password" type="password" class="input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
          <span class="icon is-small is-left">
          <i class="fa fa-lock"></i>
          </span>
        </p>
      </div>
      <div class="field">
        <p class="control">
          <button class="button is-success">
            Login
          </button>
          <a class="button" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
        </p>
      </div>
    </form>
  </div>
@endsection
