<input type="hidden" id="hdnFacilityID" value="{{$id}}">
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            
                                        </th>
                                        <th>
                                            Facility Name
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facs as $f)
                                    <tr>
                                        <td>
                                            <input type="radio" class="optfacilitylink" name="facility" data-id="{{$f->Id}}" {{$f->IsPCC && $f->PCCFacilityId == $id ? "checked='checked'":""}}>
                                        </td>
                                        <td>
                                            {{$f->Name}}
                                        </td>
                                        <td>
                                            {{$f->Address1 . ' ' . $f->City . ', ' . $f->State . ' ' . $f->Zipcode5}}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
