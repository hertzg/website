<?php

function render_tasks ($user, &$items) {
    $num_tasks = $user->num_tasks;
    $title = 'Tasks';
    $href = '../tasks/';
    $icon = 'tasks';
    if ($num_tasks) {
        $description = "$num_tasks total.";
        $items[] = Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        $items[] = Page::imageArrowLink($title, $href, $icon);
    }
}
