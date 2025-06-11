<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Your Account</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    @if ( $user->role_id == \App\Models\ConstantModel::ROLES['personal'] )
        <p>Thank you for registering. Please activate your account by clicking the link below:</p>
        <a href="{{ $url }}">Activate Account</a>

    @endif
   @if ( $user->role_id == \App\Models\ConstantModel::ROLES['company'] )
        <p>Thank you for registering. Waiting admin appprove.</p>

    @endif
</body>
</html>
