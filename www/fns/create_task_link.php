<?php

function create_task_link ($title, $deadline_time, $tags_json,
    $top_priority, $href, $time_today, $options = [], $paint = false) {

    $icon = $top_priority ? 'task-top-priority' : 'task';

    $descriptions = [];
    if ($deadline_time !== null) {
        include_once __DIR__.'/format_deadline.php';
        $descriptions[] = 'Deadline '.format_deadline(
            $deadline_time, $time_today);
    }

    $tags = json_decode($tags_json);
    if ($tags) {
        include_once __DIR__.'/ColorTag/render.php';
        $descriptions[] = ColorTag\render($tags, $paint);
    }

    if ($descriptions) {
        $description = join(' &middot ', $descriptions);
        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);
    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
