<?php

function get_ranges ($monthSelected,
    $calendarStartTime, $monthStartTime, $nextMonthStartTime) {

    $ranges = [];

    if ($calendarStartTime < $monthStartTime) {
        $month = date('n', $calendarStartTime);
        $ranges[] = [
            'from' => [
                'day' => date('j', $calendarStartTime),
                'month' => $month,
            ],
            'to' => [
                'day' => date('j', $monthStartTime - 24 * 60 * 60),
                'month' => $month,
            ],
        ];
    }

    $ranges[] = [
        'from' => [
            'day' => '1',
            'month' => $monthSelected,
        ],
        'to' => [
            'day' => date('j', $nextMonthStartTime - 24 * 60 * 60),
            'month' => $monthSelected,
        ],
    ];

    $month = date('n', $nextMonthStartTime);
    $ranges[] = [
        'from' => [
            'day' => '1',
            'month' => $month,
        ],
        'to' => [
            'day' => date('j', $calendarStartTime + (6 * 7 - 1) * 24 * 60 * 60),
            'month' => $month,
        ],
    ];

    return $ranges;

}
