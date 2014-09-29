<?php

function render_notifications ($user, &$items) {

    if (!$user->show_notifications) return;

    $fnsDir = __DIR__.'/../../fns';

    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    if ($num_notifications) {
        $description = '';
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {

            $description = "$num_new_notifications new.";
            if ($num_new_notifications != $num_notifications) {
                $description .= " $num_notifications total.";
            }

            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $link = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'notification');

        } else {
            $description = "$num_notifications total.";
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $link = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'old-notification');
        }
    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = Page\imageArrowLink($title, $href, 'old-notification');
    }

    $items['notifications'] = $link;

}
