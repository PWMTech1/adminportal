@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="card-title text-white">Add User</h4>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-light">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
              <div class="card-body ">
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" id="input-name" type="text" placeholder="{{ __('First Name') }}" value="{{ old('firstname') }}" required="true" aria-required="true"/>
                      @if ($errors->has('firstname'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('firstname') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" id="input-name" type="text" placeholder="{{ __('Last Name') }}" value="{{ old('lastname') }}" required="true" aria-required="true"/>
                      @if ($errors->has('lastname'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('lastname') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="roleid" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->Id }}">{{$role->Description}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __(' Password') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
                <a href="javascript:;" class="btn btn-success">Edit Facilities</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection