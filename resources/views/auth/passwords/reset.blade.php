@extends('layouts.base.master')
@include('layouts.base.parts.home-header')
@section('content')
  <div class="container">
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
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
        <p class="control has-icons-left">
          <input id="password-confirm" type="password" class="input form-control" name="password_confirmation" required>
          <span class="icon is-small is-left">
          <i class="fa fa-lock"></i>
          </span>
        </p>
      </div>
      <div class="field">
        <button type="submit" class="button btn-primary">
          {{ __('Reset Password') }}
        </button>
      </div>
    </form>
  </div>
@endsection
