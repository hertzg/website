<?php

function render_phone_number ($label, $number, &$items, $keyword = '') {
    if ($number !== '') {
        $number = htmlspecialchars($number);
        $href = 'tel:'.preg_replace('/\s+/', '', $number);
        if ($keyword !== '') {
            $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
            $number = preg_replace($regex, '<mark>$0</mark>', $number);
        }
        include_once __DIR__.'/../../fns/Form/link.php';
        $items[] = Form\link($label, $number, $href, 'phone');
    }
}
