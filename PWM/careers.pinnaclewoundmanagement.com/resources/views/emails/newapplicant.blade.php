<h3>New Applicant for {{ $applicant[0]->Title }} in {{ $applicant[0]->City . ', ' . $applicant[0]->State }}</h3>

<p>{{ $applicant[0]->First_Name }} {{ $applicant[0]->Last_Name }}</p>
<p>Email: <a href="mailto:{{ $applicant[0]->Email }}">{{ $applicant[0]->Email }}</a></p>
<p>Phone: {{ $applicant[0]->Phone_Number }}</p>
