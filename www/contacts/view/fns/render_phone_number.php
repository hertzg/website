<?php

function render_phone_number ($label, $number, &$items) {
    if ($number !== '') {
        $escapedNumber = htmlspecialchars($number);
        $href = 'tel:'.preg_replace('/\s+/', '', $escapedNumber);
        include_once __DIR__.'/../../../fns/Form/link.php';
        $items[] = Form\link($label, $escapedNumber, $href, 'phone');
    }
}
