<?php

namespace ViewPage;

function cashflowPanel ($mysqli, $user, $wallet) {

    if (!$wallet->num_transactions) return;

    $fnsDir = __DIR__.'/../../../fns';
    $timezone_offset = $user->timezone * 60;

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);
    $monthToday = date('n', $timeToday);
    $yearToday = date('Y', $timeToday);

    $month_start_time = mktime(0, 0, 0, $monthToday, 1, $yearToday);
    $prev_month_start_time = mktime(0, 0, 0, $monthToday - 1, 1, $yearToday);

    include_once "$fnsDir/WalletTransactions/indexOnWalletSince.php";
    $transactions = \WalletTransactions\indexOnWalletSince(
        $mysqli, $wallet->id, $prev_month_start_time - $timezone_offset);

    $months = [];
    $add_month = function ($time) use (&$months) {
        $months[date('Ym', $time)] = [
            'time' => $time,
            'expense' => 0,
            'income' => 0,
        ];
    };
    $add_month($month_start_time);
    if ($wallet->insert_time < $month_start_time) {
        $add_month($prev_month_start_time);
    }

    $max_income = $max_expense = 0;
    foreach ($transactions as $transaction) {
        $key = date('Ym', $transaction->insert_time + $timezone_offset);
        $amount = $transaction->amount;
        if ($amount < 0) {
            $expense = &$months[$key]['expense'];
            $expense += $amount;
            if ($expense < $max_expense) $max_expense = $expense;
            unset($expense);
        } else {
            $income = &$months[$key]['income'];
            $income += $amount;
            if ($income > $max_income) $max_income = $income;
            unset($income);
        }
    }

    $range = max($max_income, -$max_expense);

    $items = [];
    include_once "$fnsDir/Form/label.php";
    foreach ($months as $month) {

        $expense = $month['expense'];
        $income = $month['income'];
        $sum = $income + $expense;

        if ($range > 0) {
            $redWidth = -$expense * 50 / $range;
            $greenWidth = $income * 50 / $range;
        } else {
            $redWidth = $greenWidth = 0;
        }

        $centerClass = 'cashflow-numbers-center';
        if ($sum < 0) $centerClass .= ' colorText red';

        $content =
            '<div class="cashflow-numbers">'
                .'<div class="cashflow-numbers-left colorText red">'
                    .number_format($expense / 100, 2)
                .'</div>'
                .'<div class="cashflow-numbers-right">'
                    .number_format($income / 100, 2)
                .'</div>'
                ."<div class=\"$centerClass\">"
                    .number_format($sum / 100, 2)
                .'</div>'
            .'</div>'
            .'<div class="cashflow-bars">'
                .'<div class="cashflow-bars-red"'
                ." style=\"width: $redWidth%\">"
                .'</div>'
                .'<div class="cashflow-bars-green"'
                ." style=\"width: $greenWidth%\">"
                .'</div>'
            .'</div>';

        $items[] = \Form\label(date('F', $month['time']), $content);

    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Cashflow', $content);

}
