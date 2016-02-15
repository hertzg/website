<?php

namespace HomePage;

function renderNotifications ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_post_notification) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['post-notification'] = \Page\thumbnailLink(
            'Post a Notification', '../notifications/post/',
            'create-notification');
    }

    if (!$user->show_notifications) return;

    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    $options = ['id' => 'notifications'];
    if ($num_notifications) {
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {

            $description =
                '<span class="colorText red">'
                    ."$num_new_notifications&nbsp;new."
                .'</span>';
            if ($num_new_notifications != $num_notifications) {
                $description .= " $num_notifications&nbsp;total.";
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
