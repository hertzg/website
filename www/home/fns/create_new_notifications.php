<?php

function create_new_notifications ($mysqli, $user) {
    $num_notifications = $user->num_new_notifications_for_home;
    if ($num_notifications) {

        include_once __DIR__.'/../../fns/Page/warnings.php';
        $html = Page\warnings(array(
            "$num_notifications new notifications.",
        ));

        include_once __DIR__.'/../../fns/Users/clearNumNewNotificationsForHome.php';
        Users\clearNumNewNotificationsForHome($mysqli, $user->idusers);

    } else {
        $html = '';
    }
    return $html;
}
