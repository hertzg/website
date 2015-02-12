<?php

namespace HomePage;

function renderTasks ($user, &$items) {

    if (!$user->show_tasks) return;

    $fnsDir = __DIR__.'/..';

    $num_tasks = $user->num_tasks;
    $num_received_tasks = $user->num_received_tasks;

    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    $options = ['id' => 'tasks'];
    if ($num_tasks || $num_received_tasks) {

        $descriptions = [];
        if ($num_tasks) $descriptions[] = "$num_tasks total.";
        if ($num_received_tasks) {
            $descriptions[] = "$num_received_tasks received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['tasks'] = $link;

}
