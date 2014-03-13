<?php

function render_phone_number ($label, $number, &$items) {
    if ($number !== '') {
        $escapedNumber = htmlspecialchars($number);
        include_once '../../fns/Form/link.php';
        $items[] = Form\link($label, $escapedNumber, "tel:$escapedNumber");
    }
}
