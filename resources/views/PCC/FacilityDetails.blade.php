<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Facility Details
    </div>
</div>
<div class="row pt-2">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Facility Name: </strong></label>
            <label>{{$facs[0]->FacilityName}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Type: </strong></label>
            <label>{{empty($facs[0]->Type) ? "" : $facs[0]->Type }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Type Desc: </strong></label>
            <label>{{empty($facs[0]->TypeDesc) ? "" : $facs[0]->TypeDesc }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Code: </strong></label>
            <label>{{$facs[0]->FacilityCode }}</label>
        </div>
    </div>
</div>
<div class="row pt-2">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Bed Count: </strong></label>
            <label>{{empty($facs[0]->BedCount) ? "" : $facs[0]->BedCount}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Phone: </strong></label>
            <label>{{empty($facs[0]->Phone) ? "" : $facs[0]->Phone}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Fax: </strong></label>
            <label>{{$facs[0]->Fax}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>TimeZone: </strong></label>
            <label>{{empty($facs[0]->TimeZone) ? "" : $facs[0]->TimeZone }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="form-group mb-0">
            <label><strong>Address: </strong></label>
            <label>{{$facs[0]->AddressLine1 . ' ' . $facs[0]->City . ' ' . $facs[0]->State . ' ' . $facs[0]->PostalCode . ' ' . $facs[0]->Country}}</label>
        </div>
    </div>
</div>
