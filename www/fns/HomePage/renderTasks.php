<?php

namespace HomePage;

function renderTasks ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_task) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-task'] = \Page\thumbnailLink(
            'New Task', '../tasks/new/', 'create-task');
    }

    if (!$user->show_tasks) return;

    $num_tasks = $user->num_tasks;
    $num_new_received = $user->num_received_tasks -
        $user->num_archived_received_tasks;

    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    $options = ['id' => 'tasks'];
    if ($num_tasks || $num_new_received) {

        $descriptions = [];
        if ($num_tasks) $descriptions[] = "$num_tasks total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received new received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['tasks'] = $link;

}
