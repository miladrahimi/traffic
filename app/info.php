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
        <aside class="col-md-3 py-3 rounded-3 mb-1">
            <a href="/" class="display-5 bg-dark text-light py-3 mb-3 rounded-3">Ateriad</a>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true"><a href="index.php">Traffic</a></li>
                <li class="list-group-item bg-dark" aria-current="true"><a href="info.php">Information</a></li>
            </ul>
        </aside>
        <main class="col-md-4">
            <div class="card bg-light mb-3">
                <div class="card-header">Information</div>
                <div class="card-body" dir="rtl">
                    <p><strong>نام و نام خانوادگی:</strong> <span>میلاد رحیمی</span></p>
                    <p><strong>نام پدر:</strong> <span>آزادخان</span></p>
                    <p><strong>کد ملی:</strong> <span>4200252430</span></p>
                    <p><strong>شماره همراه:</strong> <span>09129561401</span></p>
                    <p><strong>تاریخ تولد:</strong> <span>۱ دی ۱۳۷۲</span></p>
                    <p><strong>محل تولد:</strong> <span>شهرستان نورآباد دلفان از استان لرستان</span></p>
                    <p><strong>تاریخ اعزام:</strong> <span>اردیبهشت ۱۴۰۰</span></p>
                </div>
            </div>
        </main>
        <main class="col-md-5">
            <div class="card bg-light mb-3">
                <div class="card-header">Information</div>
                <div class="card-body" dir="rtl">
                    <p>
                        <strong>دی ۱۴۰۰:</strong>
                        <span>تست بار و رفع ایرادات موجود و بهینه سازی سرویس ها</span>
                    </p>
                    <p>
                        <strong>بهمن ۱۴۰۰:</strong>
                        <span>طراحی معماری یکپارچه سرویس ها راه اندازی سرور ابری</span>
                    </p>
                    <p>
                        <strong>اسفند ۱۴۰۰:</strong>
                        <span>طراحی و مستند سازی وب سرویس (إی-پی-آی) های یکپارچه برای میرول</span>
                    </p>
                    <p>
                        <strong>فروردین ۱۴۰۱:</strong>
                        <span>ارتقای سرویس ها از لحاظ فضای فایل، پهنای باند و سرعت ارتباط</span>
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="assets/scripts/jquery-3.6.0.min.js"></script>
<script src="assets/bootstrap-5.1.0/js/bootstrap.min.js"></script>

</body>
</html>