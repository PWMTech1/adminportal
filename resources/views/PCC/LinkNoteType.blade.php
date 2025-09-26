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
                                            Note Type
                                        </th>
                                        <th>
                                            Show24HourReport
                                        </th>
                                        <th>
                                            ShowOnShiftReport
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($types as $t)
                                    <tr>
                                        <td>
                                            <input type="radio" class="optnotetypelink" name="notetype" data-id="{{$t->ProgressNoteTypeId}}" {{$t->EligibleToSend ? "checked='checked'":""}}>
                                        </td>
                                        <td>
                                            {{$t->NoteType}}
                                        </td>
                                        <td>
                                            {{$t->Show24HourReport ? "Yes" : "No"}}
                                        </td>
                                        <td>
                                            {{$t->ShowOnShiftReport ? "Yes" : "No"}}
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
