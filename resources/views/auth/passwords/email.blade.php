@extends('layouts.base.master')
@section('content')
  @include('layouts.base.parts.home-header')
  <div class="container">
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="field">
        <p class="control has-icons-left has-icons-right">
          <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
        <button type="submit" class="button">
          {{ __('Send Password Reset Link') }}
        </button>
      </div>
    </form>
  </div>
@endsection
