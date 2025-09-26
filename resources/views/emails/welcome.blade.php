<p>
    Hi, {{$user->firstname}} {{$user->lastname}}
</p>
@if($user->roleid == 5 || $user->roleid == 6)
    <h4>Welcome to portal.innovativemedsolution.com</h4>
    <h4 style="font-weight: normal;">
        This portal allows access to retrieve your residents progress note for services rendered by a Pinnacle Wound Management affiliated provider.
    </h4>
@else
<h4>Welcome to admin.innovativemedsolution.com</h4>
@endif
<br/>
Your registered email-id is {{$user['email']}}
<p>
    Your temporary password is {{$password}}
</p>
<p>
    Please login with above credentials and change the password.
</p>
