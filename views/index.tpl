<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="<?php echo csrf_token(); ?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Magic Test</title>

    <!-- Bootstrap -->
    <link href="assets/css/vendor.min.css" rel="stylesheet">
    <link href="assets/css/magictest.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>var magictest_jax_targetUrl = "<?php echo APP_URL . '/ajax.php' ?>";</script>
</head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://magicgroup.sg" target="_blank">Magicgroup.sg</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="<?php echo APP_URL; ?>">Home</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['user'])) { ?>
                    <li>
                        <a href="javascript:void(0)"><?php echo 'Welcome, ' . $_SESSION['user']['first_name']; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo APP_URL . '/logout.php' ?>">Logout</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="javascript:void(0)" onclick="magictest.user.showRegister();">Register</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="magictest.user.showLogin();">Login</a>
                    </li>
                <?php } ?>
                </ul>
            </div>
            <!--/.nav-collapse --> </div>
    </nav>
    <div class="container">
        <h3>Users</h3>
        <table class="table table-condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Account Type</th>
                <th>Company</th>
                <th>Activated</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
            <tr>
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['first_name'] ?></td>
                <td><?php echo $user['last_name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['type'] ?></td>
                <td><?php echo $user['company'] ?></td>
                <td><?php echo $user['confirmed']? 'Yes' : 'No'; ?></td>
                <td><?php echo $user['created']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/magictest.min.js"></script>
</body>
</html>