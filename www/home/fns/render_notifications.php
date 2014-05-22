<?php

function render_notifications ($user, array &$items) {

    if (!$user->show_notifications) return;

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $key = 'notifications';
    $num_notifications = $user->num_notifications;
    $title = 'Notifications';
    $href = '../notifications/';
    if ($num_notifications) {
        $description = '';
        $num_new_notifications = $user->num_new_notifications;
        if ($num_new_notifications) {
            $description = "$num_new_notifications new."
                ." $num_notifications total.";
            include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
            $items[$key] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'notification');
        } else {
            $description = "$num_notifications total.";
            include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
            $items[$key] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'old-notification');
        }
    } else {
        include_once "$fnsPageDir/imageArrowLink.php";
        $items[$key] = Page\imageArrowLink($title, $href, 'old-notification');
    }

}
