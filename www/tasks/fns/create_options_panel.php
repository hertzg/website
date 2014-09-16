<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

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
        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        include_once "$fnsDir/Page/imageArrowLink.php";
        $title = 'Delete All Tasks';
        $href = "{$base}delete-all/".ItemList\escapedPageQuery();
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
