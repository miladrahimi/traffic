<?php

use Carbon\Carbon;

function jalali(Carbon $gregorian, string $format = 'yyyy/MM/dd - HH:mm:ss'): string
{
    $formatter = new IntlDateFormatter(
        "fa_IR@calendar=persian",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );

    return numbers2en($formatter->format($gregorian));
}

function numbers2en(string $string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $english = range(0, 9);

    return str_replace($arabic, $english, str_replace($persian, $english, $string));
}

function gregorian(string $jalali, string $format = 'yyyy-MM-dd HH:mm:ss'): string
{
    $fmt = new IntlDateFormatter(
        'fa_IR@calendar=persian',
        IntlDateFormatter::SHORT, //date format
        IntlDateFormatter::NONE, //time format
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL
    );

    $time = $fmt->parse($jalali);

    $formatter = IntlDateFormatter::create("en_US@calendar=GREGORIAN",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );
    $result = $formatter->format($time) ?? '';

    return numbers2en($result);
}

function months(): array
{
    $result = [];

    $y = 1401;
    $m = 3;

    do {
        $item = $y . '-' . ($m < 10 ? '0' . $m : $m);
        $result[] = $item;
        $m = (($m + 1) % 13);
        $m == 0 && $m++;
        $m == 1 && $y++;
    } while ($item != jalali(Carbon::now(), 'yyyy-MM'));

    return $result;
}

function format_date(string $date): string
{
    [$y, $m, $d] = explode('/', $date);

    $y = intval($y);
    $m = intval($m);
    $d = intval($d);

    return join('/', [$y, ($m < 10 ? '0' . $m : $m), ($d < 10 ? '0' . $d : $d)]);
}

function start_of_month(string $month): string
{
    return str_replace('-', '/', $month) . '/01';
}

function end_of_month(string $month): string
{
    [$y, $m] = explode('-', $month);

    if ($m < 7) {
        return format_date("$y/$m/31");
    } elseif ($m == 12) {
        return format_date("$y/$m/29");
    } else {
        return format_date("$y/$m/30");
    }
}
