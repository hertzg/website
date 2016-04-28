<?php

function render_phone_numbers ($contact, &$items, $regex = null) {

    $link_items = [];
    $render = function ($number, $label) use ($regex, &$link_items) {

        if ($number === '') return;

        $title = htmlspecialchars($number);
        if ($regex !== null) {
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
        }
        if ($label !== '') {
            $title .= ' ('.htmlspecialchars($label).')';
        }

        $number = preg_replace('/[^+0-9]+/', '', $number);

        include_once __DIR__.'/../../fns/Page/telLink.php';
        $link_items[] = Page\telLink($number, $title);

    };
    $render($contact->phone1, $contact->phone1_label);
    $render($contact->phone2, $contact->phone2_label);
    if (!$link_items) return;

    $content = join('<div class="hr"></div>', $link_items);

    include_once __DIR__.'/../../fns/Form/association.php';
    $items[] = Form\association($content, 'Phone:');

}
