<?php

function create_options_panel ($user, $base = '') {

    $href = "{$base}new/";
    $options = array(Page::imageArrowLink('New Note', $href, 'create-note'));

    if ($user->num_notes) {
        $title = 'Delete All Notes';
        $href = "{$base}delete-all/";
        $options[] = Page::imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join(Page::HR, $options));

}
