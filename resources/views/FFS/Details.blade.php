<html>

<head>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' type='text/css'
        rel='stylesheet'>
</head>

<body>
    <div style='width:100%;'>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>MRNumber</th>
                    <th>
                        DOS
                    </th>
                    <th>
                        Facility Name
                    </th>
                    <th>CPT Code</th>
                    <th>MOdifier</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ffs as $f)
                <tr>
                    <td>{{$f->Patient_Name}}</td>
                    <td>{{$f->MRnumber}}</td>
                    <td>{{$f->DOS}}</td>
                    <td>{{$f->Facility}}</td>
                    <td>{{$f->CPT}}</td>
                    <td>{{$f->MOD}}</td>
                    <td>
                        ${{number_format($f->Clinician_FFS_Owed, 2)}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>