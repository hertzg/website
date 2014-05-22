<?php

function create_new_notifications ($mysqli, $user) {
    $num_notifications = $user->num_new_notifications_for_home;
    if ($num_notifications) {

        $fnsDir = __DIR__.'/../../fns';
        include_once "$fnsDir/Page/warnings.php";
        $html = Page\warnings([
            "$num_notifications new notifications.",
        ]);

        include_once "$fnsDir/Users/Notifications/clearNumberNewForHome.php";
        Users\Notifications\clearNumberNewForHome($mysqli, $user->id_users);

    } else {
        $html = '';
    }
    return $html;
}
