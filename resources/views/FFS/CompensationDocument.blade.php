<html>
<style>
@font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: normal;
    src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
}

@page {
    margin: 0px;
}

body {
    margin: 0px;
    font-family: 'Open Sans';
}

#outer {
    height: 100px;
    width: 100%;
    position: absolute;
    background-color: #1d2b50;
}

#inner1 {
    float: left;
    height: 100%;
    color: white;
    text-align: left;
    margin-top: 20px;
    margin-left: 20px;
}

#inner2 {
    float: right;
    height: 100%;
    color: white;
    text-align: right;
    margin-right: 30px;
    margin-top: 20px;
    font-size: 20px;
}

#inner2 div {
    color: white;
    font-size: 13px;
    font-style: italic;
}

#blue {
    background-color: #5d96d6;
    width: 100%;
    position: absolute;
    margin-top: 100px;
    height: 5px;
    padding-left: 0px;
    margin-left: 0px;
}

#clinician {
    width: 100%;
    float: left;
    text-align: left;
    font-size: 20px;
    margin-top: 110px;
    margin-left: 20px;
}

#table {
    text-align: left;
    font-size: 20px;
    margin-top: 150px;
    margin-left: 20px;
    margin-right: 20px;
}

#table table {
    width: 100%;
}

#table table th {
    background-color: #5d96d6;
    color: white;
    font-size: 15px;
    height: 15px;
    font-weight: normal;
    text-align: left;
    margin-left: 10px;
}

#innertable {
    width: 100%;
}

#innertable th {
    background-color: white !important;
    color: black !important;
    border-bottom: 1px solid #5d96d6;
}

#innertable td {
    font-size: 12px;
    padding: 3px;
}

#innertable tr {
    border-bottom: 1px solid #ddd;
}

.subtotal {
    border-bottom: none;
    background-color: #d5e6fa;
}

.grandtotal {
    background-color: #1d2b50 !important;
    color: white;
    font-size: 13px !important;
}
</style>

<body>
    <div id="outer">
        <div id="inner1">
            <!-- {{ $ffs[0]->Entity }}
            <p>
                An Affiliate of:
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAArCAYAAAA9iMeyAAAACXBIWXMAAC4jAAAuIwF4pT92AAAFFmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDg4LCAyMDIwLzA3LzEwLTIyOjA2OjUzICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIxLTA1LTAzVDExOjI3OjUzLTA0OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMS0wNS0wM1QxMToyODoxOC0wNDowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMS0wNS0wM1QxMToyODoxOC0wNDowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDphZDkwZmRjNS0wNGVmLTgw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"
                    style="width: 150px; margin-top: -15px;" />
            </p> -->
        </div>
        <div id="inner2">COMPENSATION DOCUMENT
            <div>
                Period: {{ \Carbon\Carbon::parse($ffs[0]->FromDate)->format('F Y') }}
            </div>
        </div>
    </div>
    <div id="blue"></div>
    <div id="clinician">{{ $ffs[0]->Physician }}</div>
    <div id="table">
        <table>
            <tr>
                <th>Procedure</th>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%;">Services</th>
                            <th style="width: 20%; text-align: center;">Count</th>
                            <th style="width: 20%; text-align: center;">Utilization</th>
                            <th style="width: 20%; text-align: right;">Compensation</th>
                        </tr>
                        <tr>
                            <td>Debridement - Subcutaneous < 20sq cm</td>
                            <td style="text-align: center;">
                                {{ count(collect($ffs)->where('CPT', '11042')) == 0? '0': collect($ffs)->where('CPT', '11042')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ count(collect($ffs)->where('CPT', '11042')) == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '11042')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Debridement - Subcutaneous Add-On</td>
                            <td style="text-align: center;">
                                {{ count(collect($ffs)->where('CPT', '11043')) > 0? collect($ffs)->where('CPT', '11043')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ count(collect($ffs)->where('CPT', '11043')) > 0? "$" .number_format(collect($ffs)->where('CPT', '11043')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr>
                            <td>Debridement - Bone < 20sq cm</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11044')->count() > 0? "$" .collect($ffs)->where('CPT', '11044')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11044')->count() > 0? "$" .number_format(collect($ffs)->where('CPT', '11044')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr>
                            <td>Debridement - Subcutaneous Add-On</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11045')->count() > 0? collect($ffs)->where('CPT', '11045')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11045')->count() > 0? "$" .number_format(collect($ffs)->where('CPT', '11045')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr>
                            <td>Chemical Cauterization</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '17250')->count() > 0? collect($ffs)->where('CPT', '17250')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '17250')->count() > 0? "$" .number_format(collect($ffs)->where('CPT', '17250')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr>
                            <td>Debridement - Devitalized Tissue < 20sq cm</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '97597')->count() > 0? collect($ffs)->where('CPT', '97597')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '97597')->count() > 0? "$" .number_format(collect($ffs)->where('CPT', '97597')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td>Debridement - Devitalized Tissue Add-On</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '97598')->count() > 0? collect($ffs)->where('CPT', '97598')->count(): '0' }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '97598')->count() > 0? "$" .number_format(collect($ffs)->where('CPT', '97598')->sum('Clinician_FFS_Owed'),2): "$0.00" }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td colspan="4">
                                <div style="height:1px; background-color: #5d96d6;"></div>
                            </td>
                        </tr>
                        <tr class="subtotal" style="background-color: #d5e6fa;">
                            <td style="text-align: right;">
                                Procedure Subtotal
                            </td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['11042', '11043', '11044', '11045', '17250', '97597', '97598'])->count() }}
                            </td>
                            <td></td>
                            <td style="text-align: right;">
                                ${{ number_format(
                                                  collect($ffs)->whereIn('CPT', ['11042' ,'11043', '11044', '11045', '17250', '97597', '97598'])->sum('Clinician_FFS_Owed'), 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>Initial Visit</th>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%;">Services</th>
                            <th style="width: 20%; text-align: center;">Count</th>
                            <th style="width: 20%; text-align: center;">Utilization</th>
                            <th style="width: 20%; text-align: right;">Compensation</th>
                        </tr>
                        <tr>
                            <td>New Visit - Low Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99304')->count() == 0? '0': collect($ffs)->where('CPT', '99304')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99304')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99304')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>New Visit - Moderate Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99305')->count() == 0? '0': collect($ffs)->where('CPT', '99305')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99305')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99305')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td>New Visit - High Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99306')->count() == 0? '0': collect($ffs)->where('CPT', '99306')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99306')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99306')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td colspan="4">
                                <div style="height:1px; background-color: #5d96d6;"></div>
                            </td>
                        </tr>
                        <tr class="subtotal" style="background-color: #d5e6fa;">
                            <td style="text-align: right;">
                                Procedure Subtotal
                            </td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99304', '99305', '99306'])->count() }}
                            </td>
                            <td></td>
                            <td style="text-align: right;">
                                ${{ number_format(
                                                  collect($ffs)->whereIn('CPT', ['99304', '99305', '99306'])->sum('Clinician_FFS_Owed'), 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                    Follow-up Visit
                </th>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%;">Services</th>
                            <th style="width: 20%; text-align: center;">Count</th>
                            <th style="width: 20%; text-align: center;">Utilization</th>
                            <th style="width: 20%; text-align: right;">Compensation</th>
                        </tr>
                        <tr>
                            <td>Straightforward</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99307')->count() == 0? '0': collect($ffs)->where('CPT', '99307')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99307')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99307')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Low Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99308')->count() == 0? '0': collect($ffs)->where('CPT', '99308')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99308')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99308')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Moderate Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99309')->count() == 0? '0': collect($ffs)->where('CPT', '99309')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99309')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99309')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td>High Complexity</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '99310')->count() == 0? '0': collect($ffs)->where('CPT', '99310')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '99310')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '99310')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td colspan="4">
                                <div style="height:1px; background-color: #5d96d6;"></div>
                            </td>
                        </tr>
                        <tr class="subtotal" style="background-color: #d5e6fa;">
                            <td style="text-align: right;">
                                Procedure Subtotal
                            </td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99307', '99308', '99309', '99310'])->count() }}
                            </td>
                            <td></td>
                            <td style="text-align: right;">
                                ${{ number_format(
                                                  collect($ffs)->whereIn('CPT', ['99307', '99308', '99309', '99310'])->sum('Clinician_FFS_Owed'), 2) }}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                    Podiatry
                </th>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%;">Services</th>
                            <th style="width: 20%; text-align: center;">Count</th>
                            <th style="width: 20%; text-align: center;">Utilization</th>
                            <th style="width: 20%; text-align: right;">Compensation</th>
                        </tr>
                        <tr>
                            <td>Nail Trimming any number</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11719')->count() == 0? '0': collect($ffs)->where('CPT', '11719')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11719')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '11719')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nail Debridement any method; 1 to 5</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11720')->count() == 0? '0': collect($ffs)->where('CPT', '11720')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11720')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '11720')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td>Nail Debridement any methods 6+</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11721')->count() == 0? '0': collect($ffs)->where('CPT', '11721')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11721')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '11721')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td colspan="4">
                                <div style="height:1px; background-color: #5d96d6;"></div>
                            </td>
                        </tr>
                        <tr class="subtotal" style="background-color: #d5e6fa;">
                            <td style="text-align: right;">
                                Procedure Subtotal
                            </td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['11719', '11720', '11721'])->count() }}
                            </td>
                            <td></td>
                            <td style="text-align: right;">
                                ${{ number_format(
                                                  collect($ffs)->whereIn('CPT', ['11719', '11720', '11721'])->sum('Clinician_FFS_Owed'), 2) }}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                    Other Procedures
                </th>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%;">Services</th>
                            <th style="width: 20%; text-align: center;">Count</th>
                            <th style="width: 20%; text-align: center;">Utilization</th>
                            <th style="width: 20%; text-align: right;">Compensation</th>
                        </tr>
                        <tr>
                            <td>Exc tr-ext b9+marg 1.1-2 cm</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->where('CPT', '11402')->count() == 0? '0': collect($ffs)->where('CPT', '11402')->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->where('CPT', '11402')->count() == 0? "$0.00": "$" .number_format(collect($ffs)->where('CPT', '11402')->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Application of Skin Substitute Graft</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['15271', '15272', '15275', '15276'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['15271', '15272', '15275', '15276'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['15271', '15272', '15275', '15276'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['15271', '15272', '15275', '15276'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Celera, Epieffect, Epicord or Epifx</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>ALF/Home Care Straightforward</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99347', '99341'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['99347', '99341'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['99347', '99341'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['99347', '99341'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>ALF/Home Care Low Level</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99348', '99342'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['99348', '99342'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['99348', '99342'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['99348', '99342'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>ALF/Home Care Medium Level</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99349'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['99349'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['99349'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['99349'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>ALF/Home Care High Level</td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['99350', '99345'])->count() == 0? '0': collect($ffs)->whereIn('CPT', ['99350', '99345'])->count() }}
                                </th>
                            <td></td>
                            <td style="text-align: right;">
                                {{ collect($ffs)->whereIn('CPT', ['99350', '99345'])->count() == 0? "$0.00": "$" .number_format(collect($ffs)->whereIn('CPT', ['99350', '99345'])->sum('Clinician_FFS_Owed'),2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td colspan="4">
                                <div style="height:1px; background-color: #5d96d6;"></div>
                            </td>
                        </tr>
                        <tr class="subtotal" style="background-color: #d5e6fa;">
                            <td style="text-align: right;">
                                Procedure Subtotal
                            </td>
                            <td style="text-align: center;">
                                {{ collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186', '15271', '15272', '15275', '15276', '99347', '99348', '99349', '99350', '99341', '99342', '99344', '99345'])->count() }}
                            </td>
                            <td></td>
                            <td style="text-align: right;">
                                ${{ number_format(
                                                  collect($ffs)->whereIn('CPT', ['Q4278', 'Q4259', 'Q4187', 'Q4186', '15271', '15272', '15275', '15276', '99347', '99348', '99349', '99350', '99341', '99342', '99344', '99345'])->sum('Clinician_FFS_Owed'), 2) }}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="grandtotal" style="width: 40%; text-align: right;">Total Services</th>
                            <th class="grandtotal" style="width: 20%; text-align: center;">
                                {{ collect($ffs)->count() }}
                            </th>
                            <th class="grandtotal" style="width: 20%; text-align: center;"></th>
                            <th style="text-align: right;">
                                ${{ number_format(
                                                  (collect($ffs)->sum('Clinician_FFS_Owed')), 2) }}

                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="innertable" cellpadding="0" cellspacing="0">
                        @foreach ($clinicianadjustment as $ca)
                        <tr>
                            <td style="width: 40%; text-align: right;">
                                {{ $ca->Description }}
                            </td>
                            <td colspan="3" style="text-align: right;">
                                ${{ number_format($ca->Amount, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th style="width: 40%; text-align: right;">Total Compensation</th>
                            <th colspan="3" style="width: 20%; text-align: right;">
                                ${{ number_format(
                                    collect($ffs)->sum('Clinician_FFS_Owed')
                                                + collect($clinicianadjustment)->sum('Amount'), 2) }}
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>