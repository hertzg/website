<?php

namespace HomePage;

function renderTasks ($user) {

    $fnsDir = __DIR__.'/..';

    $num_tasks = $user->num_tasks;
    $num_new_received = $user->num_received_tasks -
        $user->num_archived_received_tasks;

    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    $options = ['id' => 'tasks'];

    if ($num_tasks || $num_new_received) {

        $descriptions = [];
        if ($num_tasks) $descriptions[] = "$num_tasks&nbsp;total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
