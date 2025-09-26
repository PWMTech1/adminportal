<table style="width:100%; padding: 2px; " cellspacing="0">
    <tr>
        <td class="col-etiology" style="background-color: #c0c2c3;">
            <strong>Wound Location #{{$index + 1}}:</strong>
            @if(count($woundinfo) > 0)
                @if($woundinfo[$index]->Location == "Other")
                    {{$woundinfo[$index]->OtherLocation}}
                @else
                    {{$woundinfo[$index]->Location}}
                @endif
            @endif
        </td>
        <td class="col-etiology" style="background-color: #c0c2c3;">
            <strong>Wound Location #{{$index + 2}}:</strong>
            @if(count($woundinfo) > 1)
                @if($woundinfo[$index + 1]->Location == "Other")
                    {{$woundinfo[$index + 1]->OtherLocation}}
                @else
                    {{$woundinfo[$index + 1]->Location}}
                @endif
            @endif
        </td>
        <td class="col-etiology" style="background-color: #c0c2c3;">
            <strong>Wound Location #{{$index + 3}}:</strong>
            @if(count($woundinfo) > 2)
                @if($woundinfo[$index + 2]->Location == "Other")
                    {{$woundinfo[$index + 2]->OtherLocation}}
                @else
                    {{$woundinfo[$index + 2]->Location}}
                @endif
            @endif
        </td>
        <td class="col-etiology" style="background-color: #c0c2c3;">
            <strong>Wound Location # {{$index + 4}}:</strong>
            @if(count($woundinfo) > 3)
                @if($woundinfo[$index + 3]->Location == "Other")
                    {{$woundinfo[$index + 3]->OtherLocation}}
                @else
                    {{$woundinfo[$index + 3]->Location}}
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-etiology">
            <strong>Etiology:</strong>
            @if(count($woundinfo) > 0)
                @if($woundinfo[$index]->Etiology == "Other")
                    {{$woundinfo[$index]->OtherEtiology}}
                @else
                    {{$woundinfo[$index]->Etiology}}
                @endif
            @endif
        </td>
        <td class="col-etiology">
            <strong>Etiology:</strong>
            @if(count($woundinfo) > 1)
                @if($woundinfo[$index + 1]->Etiology == "Other")
                    {{$woundinfo[$index + 1]->OtherEtiology}}
                @else
                    {{$woundinfo[$index + 1]->Etiology}}
                @endif
            @endif
        </td>
        <td class="col-etiology">
            <strong>Etiology:</strong>
            @if(count($woundinfo) > 2)
                @if($woundinfo[$index + 2]->Etiology == "Other")
                    {{$woundinfo[$index + 2]->OtherEtiology}}
                @else
                    {{$woundinfo[$index + 2]->Etiology}}
                @endif
            @endif
        </td>
        <td class="col-etiology">
            <strong>Etiology:</strong>
            @if(count($woundinfo) > 3)
                @if($woundinfo[$index + 3]->Etiology == "Other")
                    {{$woundinfo[$index + 3]->OtherEtiology}}
                @else
                    {{$woundinfo[$index + 3]->Etiology}}
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-asthetic">
            <strong>Dimensions:</strong>
            @if(count($woundinfo) > 0)
               {{$woundinfo[$index]->Length . " X " . $woundinfo[$index]->Width . " X " . $woundinfo[$index]->Depth}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Dimensions:</strong>
            @if(count($woundinfo) > 1)
               {{$woundinfo[$index + 1]->Length . " X " . $woundinfo[$index + 1]->Width . " X " . $woundinfo[$index + 1]->Depth}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Dimensions:</strong>
            @if(count($woundinfo) > 2)
               {{$woundinfo[$index + 2]->Length . " X " . $woundinfo[$index + 2]->Width . " X " . $woundinfo[$index + 2]->Depth}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Dimensions:</strong>
            @if(count($woundinfo) > 3)
               {{$woundinfo[$index + 3]->Length . " X " . $woundinfo[$index + 3]->Width . " X " . $woundinfo[$index + 3]->Depth}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-asthetic">
            <strong>(Prior Dimensions):</strong>
        </td>
        <td class="col-asthetic">
            <strong>(Prior Dimensions):</strong>
        </td>
        <td class="col-asthetic">
            <strong>(Prior Dimensions):</strong>
        </td>
        <td class="col-asthetic">
            <strong>(Prior Dimensions):</strong>
        </td>
    </tr>
    <tr>
        <td class="col-percentages">
            <table style="width: 100%;" cellspacing="0">
                <tr>
                    <td style="width:25%; height:30px; border-right: 1px solid #000; vertical-align: top;">
                        <strong>%. Gran</strong>
                        @if(count($woundinfo) > 0)
                            {{$woundinfo[$index]->Granulation}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Slough</strong>
                        @if(count($woundinfo) > 0)
                            {{$woundinfo[$index]->Slough}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Eschar</strong>
                        @if(count($woundinfo) > 0)
                            {{$woundinfo[$index]->Eschar}}
                        @endif
                    </td>
                    <td style="width:25%; vertical-align: top;">
                        <strong>Epith</strong>
                        @if(count($woundinfo) > 0)
                            {{$woundinfo[$index]->Epithialization}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="col-percentages">
            <table style="width: 100%;" cellspacing="0">
                <tr>
                    <td style="width:25%; height:30px; border-right: 1px solid #000; vertical-align: top;">
                        <strong>%. Gran</strong>
                        @if(count($woundinfo) > 1)
                            {{$woundinfo[$index + 1]->Granulation}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Slough</strong>
                        @if(count($woundinfo) > 1)
                            {{$woundinfo[$index + 1]->Slough}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Eschar</strong>
                        @if(count($woundinfo) > 1)
                            {{$woundinfo[$index + 1]->Eschar}}
                        @endif
                    </td>
                    <td style="width:25%; vertical-align: top;">
                        <strong>Epith</strong>
                        @if(count($woundinfo) > 1)
                            {{$woundinfo[$index + 1]->Epithialization}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="col-percentages">
            <table style="width: 100%;" cellspacing="0">
                <tr>
                    <td style="width:25%; height:30px; border-right: 1px solid #000; vertical-align: top;">
                        <strong>%. Gran</strong>
                        @if(count($woundinfo) > 2)
                            {{$woundinfo[$index + 2]->Granulation}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Slough</strong>
                        @if(count($woundinfo) > 2)
                            {{$woundinfo[$index + 2]->Slough}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Eschar</strong>
                        @if(count($woundinfo) > 2)
                            {{$woundinfo[$index + 2]->Eschar}}
                        @endif
                    </td>
                    <td style="width:25%; vertical-align: top;">
                        <strong>Epith</strong>
                        @if(count($woundinfo) > 2)
                            {{$woundinfo[$index + 2]->Epithialization}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="col-percentages">
            <table style="width: 100%;" cellspacing="0">
                <tr>
                    <td style="width:25%; height:30px; border-right: 1px solid #000; vertical-align: top;">
                        <strong>%. Gran</strong>
                        @if(count($woundinfo) > 3)
                            {{$woundinfo[$index + 3]->Granulation}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Slough</strong>
                        @if(count($woundinfo) > 3)
                            {{$woundinfo[$index + 3]->Slough}}
                        @endif
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Eschar</strong>
                        @if(count($woundinfo) > 3)
                            {{$woundinfo[$index + 3]->Eschar}}
                        @endif
                    </td>
                    <td style="width:25%; vertical-align: top;">
                        <strong>Epith</strong>
                        @if(count($woundinfo) > 3)
                            {{$woundinfo[$index + 3]->Epithialization}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="col-asthetic">
            <strong>Tunelling/undermining at:</strong>
            <br>
            @if(count($woundinfo) > 0 && $woundinfo[$index]->TunnelingPosition != "" && $woundinfo[$index]->TunnelingDistance != "")
                Tun. : {{'Pos.' . $woundinfo[$index]->TunnelingPosition . ', Dist. ' . $woundinfo[$index]->TunnelingDistance}}
            @endif                        
            @if(count($woundinfo) > 0 && $woundinfo[$index]->UnderminingStart != "" && $woundinfo[$index]->UnderminingEnd != "" && $woundinfo[$index]->UnderminingDistance != "")
            <br>Under. : {{'Start-' . $woundinfo[$index]->UnderminingStart . ', End-' . $woundinfo[$index]->UnderminingEnd . ', Dist.-' . $woundinfo[$index]->UnderminingDistance}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Tunelling/undermining at:</strong>
            <br>
            @if(count($woundinfo) > 1 && $woundinfo[$index + 1]->TunnelingPosition != "" && $woundinfo[$index + 1]->TunnelingDistance != "")
                Tun. : {{'Pos.' . $woundinfo[$index + 1]->TunnelingPosition . ', Dist. ' . $woundinfo[$index + 1]->TunnelingDistance}}
            @endif                        
            @if(count($woundinfo) > 1 && $woundinfo[$index + 1]->UnderminingStart != "" && $woundinfo[$index + 1]->UnderminingEnd != "" && $woundinfo[$index + 1]->UnderminingDistance != "")
            <br>Under. : {{'Start-' . $woundinfo[$index + 1]->UnderminingStart . ', End-' . $woundinfo[$index + 1]->UnderminingEnd . ', Dist.-' . $woundinfo[$index + 1]->UnderminingDistance}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Tunelling/undermining at:</strong>
            <br>
            @if(count($woundinfo) > 2 && $woundinfo[$index + 2]->TunnelingPosition != "" && $woundinfo[$index + 2]->TunnelingDistance != "")
                Tun. : {{'Pos.' . $woundinfo[$index + 2]->TunnelingPosition . ', Dist. ' . $woundinfo[$index + 2]->TunnelingDistance}}
            @endif                        
            @if(count($woundinfo) > 2 && $woundinfo[$index + 2]->UnderminingStart != "" && $woundinfo[$index + 2]->UnderminingEnd != "" && $woundinfo[$index + 2]->UnderminingDistance != "")
            <br>Under. : {{'Start-' . $woundinfo[$index + 2]->UnderminingStart . ', End-' . $woundinfo[$index + 2]->UnderminingEnd . ', Dist.-' . $woundinfo[$index + 2]->UnderminingDistance}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Tunelling/undermining at:</strong>
            <br>
            @if(count($woundinfo) > 3 && $woundinfo[$index + 3]->TunnelingPosition != "" && $woundinfo[$index + 3]->TunnelingDistance != "")
                Tun. : {{'Pos.' . $woundinfo[$index + 3]->TunnelingPosition . ', Dist. ' . $woundinfo[$index + 3]->TunnelingDistance}}
            @endif                        
            @if(count($woundinfo) > 3 && $woundinfo[$index + 3]->UnderminingStart != "" && $woundinfo[$index + 3]->UnderminingEnd != "" && $woundinfo[$index + 3]->UnderminingDistance != "")
            <br>Under. : {{'Start-' . $woundinfo[$index + 3]->UnderminingStart . ', End-' . $woundinfo[$index + 3]->UnderminingEnd . ', Dist.-' . $woundinfo[$index + 3]->UnderminingDistance}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-asthetic">
            <strong>Drainage:</strong>
            @if(count($woundinfo) > 0)
                {{'Type: ' . $woundinfo[$index]->ExudateType}}
                @if($woundinfo[$index]->ExudateAmount == "1")
                    <span>, Amt.: None</span>
                @elseif($woundinfo[$index]->ExudateAmount == "5")
                    <span>, Amt.: Scant</span>
                @elseif($woundinfo[$index]->ExudateAmount == "2")
                    <span>, Amt.: Small</span>
                @elseif($woundinfo[$index]->ExudateAmount == "3")
                    <span>, Amt.: Moderate</span>
                @elseif($woundinfo[$index]->ExudateAmount == "4")
                    <span>, Amt.: Large</span>
                @elseif($woundinfo[$index]->ExudateAmount == "6")
                    <span>, Amt.: Copious</span>
                @endif

            @endif
        </td>
        <td class="col-asthetic">
            <strong>Drainage:</strong>
            @if(count($woundinfo) > 1)
                {{'Type: ' . $woundinfo[$index + 1]->ExudateType}}
                @if($woundinfo[$index + 1]->ExudateAmount == "1")
                    <span>, Amt.: None</span>
                @elseif($woundinfo[$index + 1]->ExudateAmount == "5")
                    <span>, Amt.: Scant</span>
                @elseif($woundinfo[$index + 1]->ExudateAmount == "2")
                    <span>, Amt.: Small</span>
                @elseif($woundinfo[$index + 1]->ExudateAmount == "3")
                    <span>, Amt.: Moderate</span>
                @elseif($woundinfo[$index + 1]->ExudateAmount == "4")
                    <span>, Amt.: Large</span>
                @elseif($woundinfo[$index + 1]->ExudateAmount == "6")
                    <span>, Amt.: Copious</span>
                @endif
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Drainage:</strong>
            @if(count($woundinfo) > 2)
                {{'Type: ' . $woundinfo[$index + 2]->ExudateType . ', Amt.: ' . $woundinfo[$index + 2]->ExudateAmount}}
                @if($woundinfo[$index + 2]->ExudateAmount == "1")
                    <span>, Amt.: None</span>
                @elseif($woundinfo[$index + 2]->ExudateAmount == "5")
                    <span>, Amt.: Scant</span>
                @elseif($woundinfo[$index + 2]->ExudateAmount == "2")
                    <span>, Amt.: Small</span>
                @elseif($woundinfo[$index + 2]->ExudateAmount == "3")
                    <span>, Amt.: Moderate</span>
                @elseif($woundinfo[$index + 2]->ExudateAmount == "4")
                    <span>, Amt.: Large</span>
                @elseif($woundinfo[$index + 2]->ExudateAmount == "6")
                    <span>, Amt.: Copious</span>
                @endif
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Drainage:</strong>
            @if(count($woundinfo) > 3)
                {{'Type: ' . $woundinfo[$index + 3]->ExudateType . ', Amt.: ' . $woundinfo[$index + 3]->ExudateAmount}}
                @if($woundinfo[$index + 3]->ExudateAmount == "1")
                    <span>, Amt.: None</span>
                @elseif($woundinfo[$index + 3]->ExudateAmount == "5")
                    <span>, Amt.: Scant</span>
                @elseif($woundinfo[$index + 3]->ExudateAmount == "2")
                    <span>, Amt.: Small</span>
                @elseif($woundinfo[$index + 3]->ExudateAmount == "3")
                    <span>, Amt.: Moderate</span>
                @elseif($woundinfo[$index + 3]->ExudateAmount == "4")
                    <span>, Amt.: Large</span>
                @elseif($woundinfo[$index + 3]->ExudateAmount == "6")
                    <span>, Amt.: Copious</span>
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Periwound:</strong>
            @if(count($woundinfo) > 0)
                {{$woundinfo[$index]->Periwound}}
            @endif
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Periwound:</strong>
            @if(count($woundinfo) > 1)
                {{$woundinfo[$index + 1]->Periwound}}
            @endif
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Periwound:</strong>
            @if(count($woundinfo) > 2)
                {{$woundinfo[$index + 2]->Periwound}}
            @endif
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Periwound:</strong>
            @if(count($woundinfo) > 3)
                {{$woundinfo[$index + 3]->Periwound}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Procedure:</strong>
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Procedure:</strong>
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Procedure:</strong>
        </td>
        <td class="col-asthetic" style="background-color: #e9ecef;">
            <strong>Procedure:</strong>
        </td>
    </tr>
    <tr>
        <td class="col-asthetic">
            <strong>Anesthetic/Instrument:</strong>
            @if(count($woundinfo) > 0)
                {{'Anes: ' . $woundinfo[$index]->Anesthetic . ', Ins.: ' . $woundinfo[$index]->Instrument}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Anesthetic/Instrument:</strong>
            @if(count($woundinfo) > 1)
                {{'Anes: ' . $woundinfo[$index + 1]->Anesthetic . ', Ins.: ' . $woundinfo[$index + 1]->Instrument}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Anesthetic/Instrument:</strong>
            @if(count($woundinfo) > 2)
                {{'Anes: ' . $woundinfo[$index + 2]->Anesthetic . ', Ins.: ' . $woundinfo[$index + 2]->Instrument}}
            @endif
        </td>
        <td class="col-asthetic">
            <strong>Anesthetic/Instrument:</strong>
            @if(count($woundinfo) > 3)
                {{'Anes: ' . $woundinfo[$index + 3]->Anesthetic . ', Ins.: ' . $woundinfo[$index + 3]->Instrument}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-progress">
            <strong>DBT Level: </strong>
            @if(count($woundinfo) > 0)
                {{$woundinfo[$index]->Tissue}}
            @endif
        </td>
        <td class="col-progress">
            <strong>DBT Level: </strong>
            @if(count($woundinfo) > 1)
                {{$woundinfo[$index + 1]->Tissue}}
            @endif
        </td>
        <td class="col-progress">
            <strong>DBT Level: </strong>
            @if(count($woundinfo) > 2)
                {{$woundinfo[$index + 2]->Tissue}}
            @endif
        </td>
        <td class="col-progress">
            <strong>DBT Level: </strong>
            @if(count($woundinfo) > 3)
                {{$woundinfo[$index + 3]->Tissue}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-progress">
            <strong>Progress: </strong>
            @if(count($woundinfo) > 0)
                {{$woundinfo[$index]->WoundStatus}}
            @endif
        </td>
        <td class="col-progress">
            <strong>Progress: </strong>
            @if(count($woundinfo) > 1)
                {{$woundinfo[$index + 1]->WoundStatus}}
            @endif
        </td>
        <td class="col-progress">
            <strong>Progress: </strong>
            @if(count($woundinfo) > 2)
                {{$woundinfo[$index + 2]->WoundStatus}}
            @endif
        </td>
        <td class="col-progress">
            <strong>Progress: </strong>
            @if(count($woundinfo) > 3)
                {{$woundinfo[$index + 3]->WoundStatus}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="col-treatment">
            <strong>Treatment:</strong>
            @if(count($woundinfo) > 0)
                {{$woundinfo[$index]->TreatmentPlan}}
            @endif
        </td>
        <td class="col-treatment">
            <strong>Treatment:</strong>
            @if(count($woundinfo) > 1)
                {{$woundinfo[$index + 1]->TreatmentPlan}}
            @endif
        </td>
        <td class="col-treatment">
            <strong>Treatment:</strong>
            @if(count($woundinfo) > 2)
                {{$woundinfo[$index + 2]->TreatmentPlan}}
            @endif
        </td>
        <td class="col-treatment">
            <strong>Treatment:</strong>
            @if(count($woundinfo) > 3)
                {{$woundinfo[$index + 3]->TreatmentPlan}}
            @endif
        </td>
    </tr>
</table>