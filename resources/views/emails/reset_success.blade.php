<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<table>
    <tr>
        <td> Dear {{ $name }}</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
            Your password as been reset. kindly login
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><a href="{{ url('/user-login') }}">Login</a></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards</td></tr>
    <tr><td>Shopping Website</td></tr>
</table>
</body>

</html>