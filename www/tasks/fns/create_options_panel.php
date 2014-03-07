<?php

function create_options_panel ($user, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $href = "{$base}new/";
    $options = array(Page\imageArrowLink('New Task', $href, 'create-task'));

    if ($user->num_tasks) {
        $title = 'Delete All Tasks';
        $href = "{$base}delete-all/";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
