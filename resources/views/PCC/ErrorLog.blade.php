<?php
$pg=1;
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
                              <h4 class="text-white ">{{ __('PointClickCare ErrorLog') }}</h4>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                ErrorId
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Detail
                                            </th>
                                            <th>
                                              Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paginator as $e)
                                        <tr>
                                            <td>
                                                {{$e->Id}}
                                            </td>
                                            <td>
                                                {{$e->ErrorId}}
                                            </td>
                                            <td>
                                                {{$e->Status }}
                                            </td>
                                            <td>
                                                {{$e->Title}}
                                            </td>
                                            <td>
                                                {{$e->Detail}}
                                            </td>
                                            <td class="text-right">
                                                {{\Carbon\Carbon::parse($e->CreatedAt)->format('m/d/Y h:m:s A')}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginating-container pagination-solid">
                                    <ul class="pagination">
                                        <li class="prev"><a href="javascript:void(0);">Prev</a></li>
                                        @foreach($paginator->links()->elements[0] as $i)
                                            
                                            <li class="{{$pg == $page ? "active" : ""}}"><a href="{{$i}}">{{$pg++}}</a></li>                                            
                                            
                                        @endforeach
                                        <li class="next"><a href="javascript:void(0);">Next</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection