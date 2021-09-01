<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/setting.php';
require __DIR__ . '/helpers.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Ateriad | Traffic!</title>
    <link rel="icon" href="assets/images/logo.png">
    <link rel="apple-touch-icon" href="assets/images/logo.png">
    <link rel="author" href="https://miladrahimi.com">
    <link rel="stylesheet" href="assets/bootstrap-5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/app.css">
</head>
<body>

<div class="container my-5">
    <div class="row">
        <aside class="col-md-3 py-3 rounded-3">
            <a href="/" class="display-5 bg-dark text-light py-3 mb-3 rounded-3">Ateriad</a>
            <ul class="list-group">
                <li class="list-group-item">Dashboard</li>
                <li class="list-group-item">Users</li>
                <li class="list-group-item">Shifts</li>
                <li class="list-group-item active" aria-current="true">Traffic</li>
                <li class="list-group-item">Extra Times</li>
                <li class="list-group-item">Sign Out</li>
            </ul>
        </aside>
        <main class="col-md-9">
            <div class="card bg-light mb-3">
                <div class="card-header">Download</div>
                <div class="card-body">
                    <form class="d-flex gap-2" action="play.php" method="get">
                        <select class="form-control" title="User" name="user" required>
                            <option value="" selected disabled>[SELECT USER]</option>
                            <?php foreach (config()['users'] as $id => $u) { ?>
                                <option value="<?php echo $id ?>"><?php echo $u['name'] ?></option>
                            <?php } ?>
                        </select>
                        <select class="form-control" title="Month" name="month" required>
                            <option value="" selected disabled>[SELECT MONTH]</option>
                            <?php foreach (months() as $m) { ?>
                                <option><?php echo $m ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" class="btn btn-primary" name="download" value="Download">
                    </form>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-header">Update</div>
                <div class="card-body">
                    <form class="d-flex gap-2" method="post" action="play.php" enctype="multipart/form-data">
                        <select class="form-control" title="User" name="user" required>
                            <option value="" selected disabled>[SELECT USER]</option>
                            <?php foreach (config()['users'] as $id => $u) { ?>
                                <option value="<?php echo $id ?>"><?php echo $u['name'] ?></option>
                            <?php } ?>
                        </select>
                        <select class="form-control" title="Month" name="month" required>
                            <option value="" selected disabled>[SELECT MONTH]</option>
                            <?php foreach (months() as $m) { ?>
                                <option><?php echo $m ?></option>
                            <?php } ?>
                        </select>
                        <input type="file" class="form-control" name="file" required>
                        <input type="submit" class="btn btn-primary" name="update" value="Update">
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="assets/scripts/jquery-3.6.0.min.js"></script>
<script src="assets/bootstrap-5.1.0/js/bootstrap.min.js"></script>

</body>
</html>