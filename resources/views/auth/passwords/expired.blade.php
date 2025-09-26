@extends('layouts.guestapp')

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
   
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('password.post_expired') }}">
        {{ csrf_field() }}

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Reset Password') }}</strong></h4>
            
          </div>
          <div class="card-body">
            
            <div class="bmd-form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                  <label>{{auth()->user()->firstname}} {{auth()->user()->lastname}}</label>
              </div>              
            </div>
            <div class="bmd-form-group{{ $errors->has('current_password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="{{ __('Old Password...') }}" value="" required>
              </div>
              @if ($errors->has('current_password'))
                <div id="password-error" class="error text-danger pl-3" for="current_password" style="display: block;">
                  <strong>{{ $errors->first('current_password') }}</strong>
                </div>
              @endif
            </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('New Password...') }}" value="" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password...') }}" required="">
              </div>
              @if ($errors->has('password_confirmation'))
                <div id="password-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
              @endif
                
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-sm">{{ __('Reset Password') }}</button>
            
          </div>
        </div>
      </form>    
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="btn btn-info btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                <span class="sidebar-normal">{{ __('Logout') }}</span>
            </a>
            </form>
    </div>
  </div>
</div>
@endsection