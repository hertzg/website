<?php

function render_events ($contacts, $tasks, $events, &$items) {

    $fnsDir = __DIR__.'/../../fns';

    $items = [];
    if ($contacts || $tasks || $events) {
        if ($contacts) {
            include_once "$fnsDir/Page/imageArrowLink.php";
            foreach ($contacts as $contact) {
                $title = '<span class="event-grey">Birthday of </span>'
                    .htmlspecialchars($contact->full_name);
                $href = "../contacts/view/?id=$contact->id";
                $items[] = Page\imageArrowLink($title, $href, 'birthday-cake');
            }
        }
        if ($tasks) {
            include_once "$fnsDir/Page/imageArrowLink.php";
            foreach ($tasks as $task) {

                if ($task->top_priority) $icon = 'top-priority-task';
                else $icon = 'task';

                $title = '<span class="event-grey">Deadline of </span>'
                    .htmlspecialchars($task->text);
                $href = "../tasks/view/?id=$task->id";
                $items[] = Page\imageArrowLink($title, $href, $icon);

            }
        }
        if ($events) {
            include_once "$fnsDir/Page/imageArrowLink.php";
            foreach ($events as $event) {
                $title = htmlspecialchars($event->text);
                $href = "view-event/?id=$event->id";
                $items[] = Page\imageArrowLink($title, $href, 'event');
            }
        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No events on this day');
    }

}
