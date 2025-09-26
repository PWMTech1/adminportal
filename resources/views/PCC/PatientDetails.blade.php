<?php
$cols = count($dia) % 2;
?>
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Demographics
    </div>
</div>
<div class="row pt-2">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Patient Name: </strong></label>
            <label>{{$pat[0]->LastName . ' ' . $pat[0]->MiddleName . ' ' . $pat[0]->FirstName}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Patient DOB: </strong></label>
            <label>{{empty($pat[0]->BirthDate) ? "" : \Carbon\Carbon::parse($pat[0]->BirthDate)->format('m/d/Y') }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Admission Date: </strong></label>
            <label>{{empty($pat[0]->AdmissionDate) ? "" : \Carbon\Carbon::parse($pat[0]->AdmissionDate)->format('m/d/Y g:i:s A') }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Email: </strong></label>
            <label>{{$pat[0]->Email }}</label>
        </div>
    </div>
</div>
<div class="row pt-2">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Bed: </strong></label>
            <label>{{(empty($pat[0]->BedId) ? "" : $pat[0]->BedId . '/') . $pat[0]->BedDesc}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Room: </strong></label>
            <label>{{(empty($pat[0]->RoomId) ? "" : $pat[0]->RoomId . '/') . $pat[0]->RoomDesc}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Floor: </strong></label>
            <label>{{$pat[0]->FloorId}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Unit: </strong></label>
            <label>{{(empty($pat[0]->UnitId) ? "" : $pat[0]->UnitId . '/') . $pat[0]->UnitDesc }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Gender: </strong></label>
            <label>{{$pat[0]->Gender}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Ethnicity: </strong></label>
            <label>{{$pat[0]->Ethnicity }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Language: </strong></label>
            <label>{{$pat[0]->LanguageDesc }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Martial Status: </strong></label>
            <label>{{$pat[0]->MartialStatus }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Home Phone: </strong></label>
            <label>{{$pat[0]->HomePhone}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>SSN: </strong></label>
            <label>{{$pat[0]->SSN }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Patient Status: </strong></label>
            <label class="text-danger">{{$pat[0]->PatientStatus }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Religion: </strong></label>
            <label>{{$pat[0]->Religion }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Smoking Status: </strong></label>
            <label>{{$pat[0]->SmokingStatusDesc}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Medicare Number: </strong></label>
            <label>{{$pat[0]->MedicareNumber }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Medicaid Number: </strong></label>
            <label>{{$pat[0]->MedicaidNumber }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>MR Number: </strong></label>
            <label>{{$pat[0]->MedicalRecordNumber }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="form-group mb-0">
            <label><strong>Address: </strong></label>
            <label>{{$pat[0]->Address1 . ' ' . $pat[0]->Address2 . ' ' . $pat[0]->City . ', ' . $pat[0]->State . ' ' . $pat[0]->PostalCode . ' ' . $pat[0]->Country }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Discharge Date:</strong></label>
            <label>{{empty($pat[0]->DischargeDate)?"":\Carbon\Carbon::parse($pat[0]->DischargeDate)->format('m/d/Y') }}</label>
        </div>
    </div>
</div>
@if(count($ob) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Vitals
    </div>
</div>
@endif
@foreach($ob as $b)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Vital Type: </strong></label>
            <label>{{$b->VitalType}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Value: </strong></label>
            <label>{{$b->VitalValue}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Unit: </strong></label>
            <label>{{$b->Unit}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>RecordedDate: </strong></label>
            <label>{{$b->RecordedDate}}</label>
        </div>
    </div>
</div>
@endforeach
@if(count($all) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Allergies
    </div>
</div>
@endif
@foreach($all as $a)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Type: </strong></label>
            <label>{{$a->Type}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Allergen: </strong></label>
            <label>{{$a->Allergen }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Category: </strong></label>
            <label>{{$a->Category }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Status: </strong></label>
            <label class="text-danger">{{$a->ClinicalStatus }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Reaction Type: </strong></label>
            <label>{{$a->ReactionType}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Reaction Note: </strong></label>
            <label>{{$a->ReactionNote }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Reaction SubType: </strong></label>
            <label>{{$a->ReactionSubType }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Severity: </strong></label>
            <label>{{$a->Severity }}</label>
        </div>
    </div>
</div>
@endforeach
@if(count($cov) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Payers (Effective Date: {{$cov[0]->EffectiveFromDateTime}})
    </div>
</div>
@endif
@foreach($cov as $c)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>{{$c->PayerRank . ': '}} </strong></label>
            <label>{{$c->PayerName}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>{{$c->PayerType . '#: '}} </strong></label>
            <label>{{$c->IssuerPlanName }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Isurance Company: </strong></label>
            <label>{{$c->IssuerName }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Effective Date: </strong></label>
            <label>{{empty($c->IssuerPlanEffectiveDate)?"":\Carbon\Carbon::parse($c->IssuerPlanEffectiveDate)->format('m/d/Y') }}</label>
        </div>
    </div>
</div>
<hr>
@endforeach
@if(count($phy) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Practitioners
    </div>
</div>
@endif
@foreach($phy as $p)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Provider: </strong></label>
            <label>{{$p->FirstName . ' ' . $p->LastName}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Type: </strong></label>
            <label>{{$p->ProviderType }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>NPI: </strong></label>
            <label>{{$p->NPI }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>UPIN: </strong></label>
            <label>{{$p->UPIN }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Office Ph.: </strong></label>
            <label>{{$p->OfficePhone}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Cell Ph.: </strong></label>
            <label>{{$p->CellPhone }}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Fax: </strong></label>
            <label>{{$p->Fax }}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group mb-0">
            <label><strong>Address: </strong></label>
            <label>{{$p->AddressLine1 . ' ' . $p->City . ', ' . $p->State . ' ' . $p->PostalCode}}</label>
        </div>
    </div>
    
</div>
<hr>
@endforeach
@if(count($dia) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Diagnosis
    </div>
</div>
@endif
@foreach($dia as $d)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Diagnosis Id: </strong></label>
            <label>{{$d->ConditionId}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Classification: </strong></label>
            <label>{{$d->ClassificationDescription}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Status: </strong></label>
            <label>{{$d->ClinicalStatus}}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>ICD10: </strong></label>
            <label>{{$d->ICD10}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>ICD Desc: </strong></label>
            <label>{{$d->ICD10Description}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Princial Diagnosis: </strong></label>
            <label>{{$d->PrincipalDiagnosis}}</label>
        </div>
    </div>
</div>
<hr>
@endforeach
@if(count($con) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Contacts
    </div>
</div>
@endif
@foreach($con as $c)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Name: </strong></label>
            <label>{{$c->FirstName . ' ' . $c->LastName}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Address: </strong></label>
            <label>{{$c->AddressLine1 . ' ' . $c->AddressLine2 . ' ' . $c->City . ' ' . $c->State . ' ' . $c->PostalCode}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Home Phone: </strong></label>
            <label>{{$c->HomePhone}}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Gender: </strong></label>
            <label>{{$c->Gender}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Relationship: </strong></label>
            <label>{{$c->Relationship}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Cell Phone: </strong></label>
            <label>{{$c->CellPhone}}</label>
        </div>
    </div>
</div>
<hr>
@endforeach
@if(count($ad) > 0)
<div class="row">
    <div class="col-lg-12 bg-light p-3">
        Advance Directives
    </div>
</div>
@endif
@foreach($ad as $a)
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Communication Method: </strong></label>
            <label>{{$a->CommunicationMethod}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Consent Status: </strong></label>
            <label>{{$a->ConsentStatus}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Order Date: </strong></label>
            <label>{{$a->OrderDate}}</label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-0">
            <label><strong>Directives: </strong></label>
            <label>{{$a->Directives}}</label>
        </div>
    </div>
</div>
<hr>
@endforeach