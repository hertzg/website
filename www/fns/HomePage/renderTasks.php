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

        $descriptionItems = [];
        if ($num_tasks) $descriptionItems[] = "$num_tasks total.";
        if ($num_received_tasks) {
            $descriptionItems[] = "$num_received_tasks received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['tasks'] = $link;

}
