
<table style="min-width:{{count($woundinfo)==4 ? "100%":count($woundinfo) * 25 ."%"}}; padding: 2px; " cellspacing="0">
    <tr>
        @foreach($woundinfo as $key=>$w)
        <td class="col-etiology">
            <strong>Wound Location #{{$key+1}}:</strong>
                @if($w->Location == "Other")
                    {{$w->OtherLocation}}
                @else
                    {{$w->Location}}
                @endif
        </td>
        @endforeach
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-etiology">
            <strong>Etiology:</strong>
                @if($w->Etiology == "Other")
                    {{$w->OtherEtiology}}
                @else
                    {{$w->Etiology}}
                @endif
            
        </td>
        @endforeach
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Dimensions:</strong>
               {{$w->Length . " X " . $w->Width . " X " . $w->Depth}}
            
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>(Prior Dimensions):</strong>
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-percentages">
            <table style="width: 100%;" cellspacing="0">
                <tr>
                    <td style="width:25%; height:30px; border-right: 1px solid #000; vertical-align: top;">
                        <strong>%. Gran</strong>
                            {{$w->Granulation}}
                        
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Slough</strong>
                            {{$w->Slough}}
                    </td>
                    <td style="width:25%; border-right: 1px solid #000; vertical-align: top;">
                        <strong>Eschar</strong>
                            {{$w->Eschar}}
                    </td>
                    <td style="width:25%; vertical-align: top;">
                        <strong>Epith</strong>
                            {{$w->Epithialization}}
                    </td>
                </tr>
            </table>
        </td>
        @endforeach
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Tunelling/undermining at:</strong>
            <br>
            @if($w->TunnelingPosition != "" && $w->TunnelingDistance != "")
                Tun. : {{'Pos.' . $w->TunnelingPosition . ', Dist. ' . $w->TunnelingDistance}}
            @endif                        
            @if($w->UnderminingStart != "" && $w->UnderminingEnd != "" && $w->UnderminingDistance != "")
            <br>Under. : {{'Start-' . $w->UnderminingStart . ', End-' . $w->UnderminingEnd . ', Dist.-' . $w->UnderminingDistance}}
            @endif
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Drainage:</strong>
                {{'Type: ' . $w->ExudateType}}
            @if($w->ExudateAmount == "1")
                <span>, Amt.: None</span>
            @elseif($w->ExudateAmount == "5")
                <span>, Amt.: Scant</span>
            @elseif($w->ExudateAmount == "2")
                <span>, Amt.: Small</span>
            @elseif($w->ExudateAmount == "3")
                <span>, Amt.: Moderate</span>
            @elseif($w->ExudateAmount == "4")
                <span>, Amt.: Large</span>
            @elseif($w->ExudateAmount == "6")
                <span>, Amt.: Copious</span>
            @endif
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Periwound:</strong>
                {{$w->Periwound}}
            
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Procedure:</strong>
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-asthetic">
            <strong>Anesthetic/Instrument:</strong>
                {{'Anes: ' . $w->Anesthetic . ', Ins.: ' . $w->Instrument}}
            
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-progress">
            <strong>DBT Level: </strong>
                {{$w->Tissue}}
            
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-progress">
            <strong>Progress: </strong>
                {{$w->WoundStatus}}
            
        </td>
        @endforeach
        
    </tr>
    <tr>
        @foreach($woundinfo as $w)
        <td class="col-treatment">
            <strong>Treatment:</strong>
                {{$w->TreatmentPlan}}
            
        </td>
        @endforeach
        
    </tr>
</table>