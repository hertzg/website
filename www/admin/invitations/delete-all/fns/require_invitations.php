<?php

function require_invitations (&$mysqli, &$invitations, &$admin_user) {

    include_once __DIR__.'/../../../fns/require_admin.php';
    $admin_user = require_admin();

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_mysqli.php";
    $mysqli = require_mysqli();

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
