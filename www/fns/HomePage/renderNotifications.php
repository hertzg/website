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

            $description =
                '<span class="redText">'
                    ."$num_new_notifications new."
                .'</span>';
            if ($num_new_notifications != $num_notifications) {
                $description .= " $num_notifications total.";
            }

            include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
            $link = \Page\thumbnailLinkWithDescription($title,
                $description, $href, 'notification', $options);

        } else {
            $description = "$num_notifications total.";
            include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
            $link = \Page\thumbnailLinkWithDescription($title,
                $description, $href, 'old-notification', $options);
        }
    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title,
            $href, 'old-notification', $options);
    }

    $items['notifications'] = $link;

}
