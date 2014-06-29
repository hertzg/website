<?php

function create_new_notifications ($mysqli, $user) {
    $num_notifications = $user->home_num_new_notifications;
    if ($num_notifications) {

        $fnsDir = __DIR__.'/../../fns';

        include_once "$fnsDir/Users/Notifications/clearNumberNewForHome.php";
        Users\Notifications\clearNumberNewForHome($mysqli, $user->id_users);

        include_once "$fnsDir/Page/warnings.php";
        return Page\warnings(["$num_notifications new notifications."]);

    }
}
