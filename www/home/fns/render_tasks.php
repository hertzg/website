<?php

function render_tasks ($user, &$items) {

    if (!$user->show_tasks) return;

    $num_tasks = $user->num_tasks;
    $num_received_tasks = $user->num_received_tasks;

    $key = 'tasks';
    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    if ($num_tasks || $num_received_tasks) {

        $descriptionItems = [];
        if ($num_tasks) {
            $descriptionItems[] = "$num_tasks total.";
        }
        if ($num_received_tasks) {
            $descriptionItems[] = "$num_received_tasks received.";
        }
        $description = join(' ', $descriptionItems);

        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
