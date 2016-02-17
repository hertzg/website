<?php

namespace HomePage;

function renderNotifications ($user) {

    $fnsDir = __DIR__.'/..';

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
            return \Page\thumbnailLinkWithDescription($title,
                $description, $href, 'notification', $options);

        }

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription(
            $title, "$num_notifications total.",
            $href, 'old-notification', $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title,
        $href, 'old-notification', $options);

}
