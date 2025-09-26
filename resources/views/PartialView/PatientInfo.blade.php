

    <tr>
        <td style="width:29%;border-bottom: 1px solid #000;">
            {{$patinfo[0]->FirstName}} {{$patinfo[0]->MiddleName}} {{$patinfo[0]->LastName}} 
        </td>
        <td style="text-align: center;">|</td>
        <td style="width:29%;border-bottom: 1px solid #000;">
            {{$patinfo[0]->FacilityName}} 
        </td>
        <td style="text-align: center;">|</td>
        <td style="width:19%;border-bottom: 1px solid #000;">
            {{$patinfo[0]->DOB}} 
        </td>
        <td style="text-align: center;">|</td>
        <td style="width:19%;border-bottom: 1px solid #000;">
            {{date('m/d/Y', strtotime($patinfo[0]->DOS))}} 
        </td>
    </tr>
    <tr>
        <td colspan="2"><strong>Patient Name</strong></td>
        <td colspan="2"><strong>Facility</strong></td>
        <td colspan="2"><strong>Date of Birth</strong></td>
        <td><strong>Date of Service</strong></td>
    </tr>
    