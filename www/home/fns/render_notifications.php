<?php

function render_notifications ($user, array &$items, &$notifications) {
    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    if ($num_notifications) {
        $description = '';
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {
            $notifications = Page::warnings(array("$num_new_notifications new notifications."));
            $description = "$num_new_notifications new. $num_notifications total.";
            $items[] = Page::imageArrowLinkWithDescription($title,
                $description, $href, 'notification');
        } else {
            $notifications = '';
            $description = "$num_notifications total.";
            $items[] = Page::imageArrowLinkWithDescription($title,
                $description, $href, 'old-notification');
        }
    } else {
        $notifications = '';
        $items[] = Page::imageArrowLink($title, $href, 'old-notification');
    }
}
