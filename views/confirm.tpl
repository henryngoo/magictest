<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h4>Hi <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h4>
    <p>Welcome you to <strong>MagicGroup</strong></p>
    <p>Your account is created successful, please access link below to active account</p>
    <p><a href="<?php echo $url; ?>"><?php echo $url; ?></a></p>
    <p>Thank you</p>
</body>
</html>