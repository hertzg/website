<?php

function require_invitations (&$mysqli, &$invitations) {

    include_once __DIR__.'/../../../fns/require_admin.php';
    require_admin();

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/get_mysqli.php";
    $mysqli = get_mysqli();

    include_once "$fnsDir/Invitations/index.php";
    $invitations = Invitations\index($mysqli);

    if (!$invitations) {
        unset(
            $_SESSION['admin/invitations/errors'],
            $_SESSION['admin/invitations/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

}