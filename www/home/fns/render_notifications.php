<?php

function render_notifications ($user, array &$items, &$notifications) {
    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    if ($num_notifications) {
        $description = '';
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {

            include_once __DIR__.'/../../fns/Page/warnings.php';
            $notifications = Page\warnings(array("$num_new_notifications new notifications."));

            $description = "$num_new_notifications new. $num_notifications total.";

            include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'notification');

        } else {
            $notifications = '';
            $description = "$num_notifications total.";
            include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'old-notification');
        }
    } else {
        $notifications = '';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[] = Page\imageArrowLink($title, $href, 'old-notification');
    }
}
