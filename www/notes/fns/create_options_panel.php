<?php

function create_options_panel ($user, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $href = "{$base}new/";
    $options = [Page\imageArrowLink('New Note', $href, 'create-note')];

    if ($user->num_notes) {
        $title = 'Delete All Notes';
        $href = "{$base}delete-all/";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
