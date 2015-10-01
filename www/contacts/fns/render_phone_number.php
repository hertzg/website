<?php

function render_phone_number ($label, $number, &$items, $keyword = '') {

    if ($number === '') return;

    $title = htmlspecialchars($number);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
    }

    $number = preg_replace('/\s+/', '', $number);

    include_once __DIR__.'/../../fns/Form/phoneNumber.php';
    $items[] = Form\phoneNumber($label, $number, $title);

}
