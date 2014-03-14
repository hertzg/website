<?php

function render_tasks ($user, &$items) {

    if (!$user->show_tasks) return;

    $num_tasks = $user->num_tasks;
    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    if ($num_tasks) {
        $description = "$num_tasks total.";
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[] = Page\imageArrowLink($title, $href, $icon);
    }

}
