<?php

function render_phone_number ($label,
    $number, $number_label, &$items, $keyword = '') {

    if ($number === '') return;

    $title = htmlspecialchars($number);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
    }
    if ($number_label !== '') {
        $title .= ' ('.htmlspecialchars($number_label).')';
    }

    $number = preg_replace('/[^+0-9]+/', '', $number);

    include_once __DIR__.'/../../fns/Form/phoneNumber.php';
    $items[] = Form\phoneNumber($label, $number, $title);

}
