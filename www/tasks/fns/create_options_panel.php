<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "{$base}new/";
    $options = [Page\imageArrowLink('New Task', $href, 'create-task')];

    $num_received_tasks = $user->num_received_tasks;
    if ($num_received_tasks) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $title = 'Received Tasks';
        $description = "$num_received_tasks total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_tasks) {
        $title = 'Delete All Tasks';
        $href = "{$base}delete-all/";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
