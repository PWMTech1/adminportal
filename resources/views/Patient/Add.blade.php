@extends('layouts.app', ['activePage' => 'addpatient', 'titlePage' => __('Add New Patient')])


@section('content')
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header bg-primary text-white">
                        Add New Patient
                    </div>
                    <div class="card-body ">
                        <div class="tab-content text-center">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{route('savepatient')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Patient Number') }}</label>
                                                    <div class="col-sm-9 text-left mt-2">
                                                        <input type="hidden" value="{{$mrnumber}}" name="mrnumber">
                                                        {{$mrnumber}}
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Last Name') }}</label>
                                                    <div class="col-sm-9">
                                                        <input tabindex="0" type="text"
                                                            class="form-control {{ $errors->has('lastname') ? 'is-invalid' : ''}}"
                                                            placeholder="Last Name" name="lastname" id="lastname"
                                                            value="{{old('lastname')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('First Name') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('firstname') ? 'is-invalid' : ''}}"
                                                            placeholder="First Name" name="firstname" id="firstname"
                                                            value="{{old('firstname')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Middle Name') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Middle Name" name="middlename" id="middlename"
                                                            value="{{old('middlename')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Facility') }}</label>
                                                    <div class="col-sm-9">
                                                        <select
                                                            class="form-control {{ $errors->has('facilityname') ? 'is-invalid' : ''}}"
                                                            name="facilityname" id="facilityname">
                                                            <option></option>
                                                            @foreach($facility as $f)
                                                            @if(old('facilityname') == $f->Id)
                                                            <option value="{{$f->Id}}" selected="selcted">{{$f->Name}}
                                                            </option>
                                                            @else
                                                            <option value="{{$f->Id}}">{{$f->Name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Admission Date') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                            class="datepicker form-control {{ $errors->has('admissiondate') ? 'is-invalid' : ''}}"
                                                            placeholder="Admission Date" name="admissiondate"
                                                            id="admissiondate" value="{{old('admissiondate')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Room') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Room"
                                                            name="room" id="room" value="{{old('room')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Bed') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Bed"
                                                            name="bed" id="bed" value="{{old('bed')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('DOB') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                            class="datepicker form-control {{ $errors->has('dob') ? 'is-invalid' : ''}}"
                                                            placeholder="DOB" name="dob" id="dob"
                                                            value="{{old('dob')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Gender') }}</label>
                                                    <div class="col-sm-9">
                                                        <select
                                                            class="form-control {{ $errors->has('gender') ? 'is-invalid' : ''}}"
                                                            name="gender">
                                                            <option></option>
                                                            <option value="F">Female</option>
                                                            <option value="M">Male</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">



                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('SSN') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="SSN"
                                                            name="ssn" id="ssn" value="{{old('ssn')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Language') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="language" id="language">
                                                            <option></option>
                                                            @foreach($language as $l)
                                                            @if(old('language') == $l->Description)
                                                            <option value="{{$l->Description}}" selected='selected'>
                                                                {{$l->Description}}</option>
                                                            @else
                                                            <option value="{{$l->Description}}">{{$l->Description}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Sexual Orientation') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="sexualorientation"
                                                            id="sexualorientation">
                                                            <option></option>
                                                            <option value="1">Bisexual</option>
                                                            <option value="2">Choose not to Disclose</option>
                                                            <option value="3">Lesbian or Gay or Homose</option>
                                                            <option value="4">Other</option>
                                                            <option value="5">Straight or Hetrosexual</option>
                                                            <option value="6">Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Religion') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="religion" id="religion">
                                                            <option></option>
                                                            @foreach($religion as $r)
                                                            @if(old('religion') == $r->Description)
                                                            <option value="{{$r->Description}}" selected='selected'>
                                                                {{$r->Description}}</option>
                                                            @else
                                                            <option value="{{$r->Description}}">{{$r->Description}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Communication') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="communication"
                                                            id="communication">
                                                            <option></option>
                                                            @foreach($communication as $c)
                                                            @if(old('communication') == $c->Description)
                                                            <option value="{{$c->Description}}" selected='selected'>
                                                                {{$c->Description}}</option>
                                                            @else
                                                            <option value="{{$c->Description}}">{{$c->Description}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Primary Insurance') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Primary Insurance" name="primaryinsurance"
                                                            id="primaryinsurance" value="{{old('PrimaryInsurance')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Policy Number') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Policy Number" name="policynumber"
                                                            id="policynumber" value="{{old('PolicyNumber')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Seconary Insurance') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Secondary Insurance" name="SecondaryInsurance"
                                                            id="secondaryinsurance"
                                                            value="{{old('secondaryinsurance')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Policy Number') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Policy Number" name="policynumber2"
                                                            id="policynumber2" value="{{old('PolicyNumber2')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Tetriary Insurance') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Tetriary Insurance" name="tetriaryinsurance"
                                                            id="tetriaryinsurance" value="{{old('TetriaryInsurance')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Policy Number') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Policy Number" name="policynumber3"
                                                            id="policynumber3" value="{{old('PolicyNumber3')}}">
                                                    </div>
                                                </div>
                                                <div class="row p-1">
                                                    <label
                                                        class="col-sm-3 col-form-label text-right">{{ __('Facesheet') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name='facesheet'
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                        @if(session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('.datepicker').datepicker();
</script>
@endsection