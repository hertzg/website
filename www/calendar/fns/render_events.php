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

                if ($task->top_priority) $icon = 'task-top-priority';
                else $icon = 'task';

                $title = '<span class="event-grey">Deadline of </span>'
                    .htmlspecialchars($task->text);
                $href = "../tasks/view/?id=$task->id";
                $items[] = Page\imageArrowLink($title, $href, $icon);

            }
        }
        if ($events) {
            include_once "$fnsDir/Page/imageArrowLink.php";
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            foreach ($events as $event) {

                $id = $event->id;
                $title = htmlspecialchars($event->text);
                $href = "view-event/?id=$id";
                $icon = 'event';
                $options = ['id' => $id];

                $start_hour = $event->start_hour;
                if ($start_hour === null) {
                    $item = Page\imageArrowLink($title, $href, $icon, $options);
                } else {
                    $description =
                        'At '.str_pad($start_hour, 2, '0', STR_PAD_LEFT).':'
                        .str_pad($event->start_minute, 2, '0', STR_PAD_LEFT);
                    $item = Page\imageArrowLinkWithDescription(
                        $title, $description, $href, $icon, $options);
                }

                $items[] = $item;

            }
        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No events on this day');
    }

}
