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
                                            Description
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($types as $t)
                                    <tr>
                                        <td>
                                            <input type="radio" class="optcategorylink" name="category" data-id="{{$t->Id}}" {{$t->EligibleToSend ? "checked='checked'":""}}>
                                        </td>
                                        <td>
                                            {{$t->Description}}
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
