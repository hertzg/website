<?php

function render_tasks ($user, &$items) {
    if ($user->show_tasks) {
        $key = 'tasks';
        $num_tasks = $user->num_tasks;
        $title = 'Tasks';
        $href = '../tasks/';
        $icon = 'tasks';
        if ($num_tasks) {
            $description = "$num_tasks total.";
            include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
            $items[$key] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);
        } else {
            include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
            $items[$key] = Page\imageArrowLink($title, $href, $icon);
        }
    }
    if ($user->show_new_task) {
        $title = 'New Task';
        $href = '../tasks/new/';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items['new-task'] = Page\imageArrowLink($title, $href, 'create-task');
    }
}
