<?php

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/setting.php';
require __DIR__ . '/helpers.php';

try {
    $result = $error = $success = '';

    function path(int $userId, string $month): string
    {
        return __DIR__ . "/sheets/u$userId-$month.xlsx";
    }

    function tempPath(int $userId, string $month): string
    {
        return __DIR__ . "/temp/u$userId-$month.xlsx";
    }

    function tempUri(int $userId, string $month): string
    {
        return "/temp/u$userId-$month.xlsx";
    }

    function setup(int $userId, string $month, string $path)
    {
        $user = config()['users'][$userId];
        $startDate = start_of_month($month);

        if (file_exists($path) == false) {
            $spreadsheet = IOFactory::load(__DIR__ . '/template.xlsx');

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue("B1", $user['name']);
            $sheet->setCellValue("D1", $user['code']);
            $sheet->setCellValue("B2", $startDate);
            $sheet->setCellValue("D2", end_of_month($month));

            $writer = new Xlsx($spreadsheet);
            $writer->save($path);
        }

        $path = path($userId, $month);
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        [$y, $m, $d] = explode('/', gregorian($startDate, 'yyyy/MM/dd'));
        $time = Carbon::createFromDate($y, $m, $d);

        for ($i = 5; true; $i++, $time->addDay()) {
            if (jalali($time, 'yyyy/MM/dd') == jalali(Carbon::now(), 'yyyy/MM/dd')) {
                break;
            }

            if (empty($sheet->getCell("A$i")->getValue())) {
                $time->setHour(8)->setMinute(random_int(15, 50))->format('H:i');

                $end = $time->clone()->addHours(9)->addMinutes(random_int(0, 120));
                $duration = $time->clone()->setHour(0)->setMinute(0)->addMinutes(
                    $end->diffInMinutes($time)
                );
                $extra = $time->clone()->setHour(0)->setMinute(0)->addMinutes(
                    $end->diffInMinutes($time) - 8 * 60
                );

                $sheet->setCellValue("A$i", jalali($time, 'yyyy/MM/dd'));
                $sheet->setCellValue("B$i", jalali($time, 'E'));
                $sheet->setCellValue("F$i", '00:00');
                $sheet->setCellValue("G$i", '00:00');
                $sheet->setCellValue("H$i", '00:00');
                $sheet->setCellValue("J$i", '00:00');

                if (in_array(jalali($time, 'E'), ['جمعه', 'پنجشنبه'])) {
                    $sheet->setCellValue("C$i", '');
                    $sheet->setCellValue("D$i", '');
                    $sheet->setCellValue("E$i", '00:00');
                    $sheet->setCellValue("I$i", '00:00');
                } else {
                    $sheet->setCellValue("C$i", $time->format('H:i'));
                    $sheet->setCellValue("D$i", $end->format('H:i'));
                    $sheet->setCellValue("E$i", $duration->format('H:i'));
                    $sheet->setCellValue("I$i", $extra->format('H:i'));
                }
            }

            if (jalali($time, 'yyyy/MM/dd') == end_of_month($month)) {
                break;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }

    if (isset($_REQUEST['download'])) {
        $path = path($_REQUEST['user'], $_REQUEST['month']);
        if (file_exists($path) == false || jalali(Carbon::now(), 'yyyy-MM') == $_REQUEST['month']) {
            setup($_REQUEST['user'], $_REQUEST['month'], $path);
        }

        $tempUri = tempUri($_REQUEST['user'], $_REQUEST['month']);
        $tempPath = tempPath($_REQUEST['user'], $_REQUEST['month']);

        $spreadsheet = IOFactory::load($path);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("H1", jalali(Carbon::now(), 'yyyy/MM/dd HH:mm'));

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        $result = "Download: <a href='$tempUri'>$tempUri</a>";
    }

    if (isset($_REQUEST['update'])) {
        $path = path($_REQUEST['user'], $_REQUEST['month']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $success = 'Month sheet updated successfully.';
        } else {
            $error = 'Failed to upload month sheet.';
        }
    }
} catch (Throwable $e) {
    exit(print_r($e));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Ateriad | Traffic! | Result</title>
    <link rel="icon" href="assets/images/logo.png">
    <link rel="apple-touch-icon" href="assets/images/logo.png">
    <link rel="author" href="https://miladrahimi.com">
    <link rel="stylesheet" href="assets/bootstrap-5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/app.css">
</head>
<body>

<div class="container my-5">
    <div class="row">
        <main class="col">
            <div class="card bg-light">
                <div class="card-header">Result</div>
                <div class="card-body">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger"><?php echo $error ?></div>
                    <?php } ?>
                    <?php if ($success) { ?>
                        <div class="alert alert-success"><?php echo $success ?></div>
                    <?php } ?>
                    <?php if ($result) { ?>
                        <div class="alert alert-info"><?php echo $result ?></div>
                    <?php } ?>
                    <div class="">
                        <a href="index.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="assets/scripts/jquery-3.6.0.min.js"></script>
<script src="assets/bootstrap-5.1.0/js/bootstrap.min.js"></script>

</body>
</html>