<?php

namespace HomePage;

function renderNotifications ($user, &$items) {

    if (!$user->show_notifications) return;

    $fnsDir = __DIR__.'/..';

    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    $options = ['id' => 'notifications'];
    if ($num_notifications) {
        $description = '';
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {

            $description = "$num_new_notifications new.";
            if ($num_new_notifications != $num_notifications) {
                $description .= " $num_notifications total.";
            }

            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $link = \Page\imageArrowLinkWithDescription($title,
                $description, $href, 'notification', $options);

        } else {
            $description = "$num_notifications total.";
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $link = \Page\imageArrowLinkWithDescription($title,
                $description, $href, 'old-notification', $options);
        }
    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title,
            $href, 'old-notification', $options);
    }

    $items['notifications'] = $link;

}
