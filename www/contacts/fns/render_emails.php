<?php

function render_emails ($contact, &$items, $regex = null) {

    $link_items = [];
    $render = function ($email, $label) use ($regex, &$link_items) {

        if ($email === '') return;

        $title = $escapedEmail = htmlspecialchars($email);
        if ($regex !== null) {
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
        }
        if ($label !== '') {
            $title .= ' ('.htmlspecialchars($label).')';
        }

        include_once __DIR__.'/../../fns/Page/imageLink.php';
        $link_items[] = Page\imageLink($title,
            "mailto:$escapedEmail", 'mail');

    };
    $render($contact->email1, $contact->email1_label);
    $render($contact->email2, $contact->email2_label);
    if (!$link_items) return;

    $content = join('<div class="hr"></div>', $link_items);

    include_once __DIR__.'/../../fns/Form/association.php';
    $items[] = Form\association($content, 'Email:');

}
