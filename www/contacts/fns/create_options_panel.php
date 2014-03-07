<?php

function create_options_panel ($user, $base = '') {

    $title = 'New Contact';
    $href = "{$base}new/";
    $options = array(Page::imageArrowLink($title, $href, 'create-contact'));

    if ($user->num_contacts) {
        $title = 'Delete All Contacts';
        $href = "{$base}delete-all/";
        $options[] = Page::imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join(Page::HR, $options));

}
