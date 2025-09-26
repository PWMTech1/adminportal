@extends('layouts.app', ['activePage' => 'facility-management', 'titlePage' => __('Facility Contact Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="float-left">
                              <h4 class="card-title ">{{ __('Facility Contacts') }}</h4>
                              <p class="card-category"> {{ __('Manage Facility contacts here') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="/Facility/EditContact/0?FacilityID={{$code}}" class="btn btn-danger">Add Contact</a>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                      <thead class=" text-primary">
                                        <th>
                                            {{ __('Name') }}
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                          {{__('Phone')}}
                                        </th>
                                        <th>
                                            Fax
                                        </th>
                                        <th>
                                          {{__('Status')}}
                                        </th>
                                        <th>
                                            WoundTracker?
                                        </th>
                                        <th class="text-right">
                                          {{ __('Actions') }}
                                        </th>
                                      </thead>
                                      <tbody>
                                        @foreach($paginator as $contact)
                                          <tr>
                                            <td>
                                              {{ $contact->FirstName . ' ' . $contact->LastName }}
                                            </td>
                                            <td>
                                              {{$contact->JobTitle}}
                                              
                                            </td>
                                            <td>
                                              {{$contact->Email}}
                                            </td>
                                            <td>
                                              {{$contact->Phone}}
                                            </td>
                                            <td>
                                              {{$contact->Fax}}
                                            </td>
                                            <td>
                                              {{$contact->Active ? "Active" : "Inactive"}}
                                            </td>
                                            <td>
                                              {{$contact->IsWoundTrackerApp ? "Receiving" : "Not Receiving"}}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a class="btn btn-success" href="/Facility/EditContact/{{$contact->ContactID}}?FacilityID={{$code}}">Edit</a>
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                      {{$paginator->links() }}
                                  </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection