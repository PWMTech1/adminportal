<?php
use Illuminate\Support\Facades\Crypt;
?>
@extends('layouts.app', ['activePage' => 'visits', 'titlePage' => __('PointClickCare')])


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="float-left">
                              <h4 class="text-white ">{{ __('PointClickCare Settings') }}</h4>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="row pt-2">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label><strong>Customer Key: </strong></label>
                                        <input type="text" class="form-control" name="txtCustomerKey" value="{{Crypt::encryptString($settings[0]->CustomerKey)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label><strong>Secret Key: </strong></label>
                                        <input type="password" class="form-control" name="txtSecretKey" value="{{Crypt::encryptString($settings[0]->SecretKey)}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label><strong>24 Limit: </strong></label>
                                        <input type="text" class="form-control" name="txtDailyLimit" value="{{$settings[0]->DailyLimit}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label><strong>Second Limit: </strong></label>
                                        <input type="text" class="form-control" name="txtSecLimit" value="{{$settings[0]->SecLimit}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pb-2">
                                <div class="col-lg-12 text-right">
                                    <a href="javascript:;" class="btn btn-sm btn-success d-none">Save</a>
                                    <a href="/pcc/facilitylist" class="btn btn-sm btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection