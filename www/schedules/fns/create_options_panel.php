<?php

function create_options_panel ($user) {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $options = [Page\imageArrowLink('New Schedule', 'new/', 'create-schedule')];

    if ($user->num_schedules) {
        $title = 'Delete All Schedules';
        $options[] = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
