<?php

function render_emails ($contact, &$items, $keyword = '') {

    $link_items = [];
    $render = function ($email) use ($keyword, &$link_items) {

        if ($email === '') return;

        $escapedEmail = htmlspecialchars($email);
        if ($keyword !== '') {
            $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
            $replace = '<mark>$0</mark>';
            $escapedEmail = preg_replace($regex, $replace, $escapedEmail);
        }

        include_once __DIR__.'/../../fns/Page/imageLink.php';
        $link_items[] = Page\imageLink($escapedEmail,
            "mailto:$escapedEmail", 'mail');

    };
    $render($contact->email1);
    $render($contact->email2);
    if (!$link_items) return;

    $content = join('<div class="hr"></div>', $link_items);

    include_once __DIR__.'/../../fns/Form/association.php';
    $items[] = Form\association($content, '<label>Email:</label>');

}
