<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_admin.php';
require_admin();

include_once '../fns/request_admin_api_key_params.php';
include_once '../../../lib/mysqli.php';
list($name, $expires, $expire_time, $invitation_access,
    $user_access) = request_admin_api_key_params($mysqli, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/api-keys/new/errors'] = $errors;
    $_SESSION['admin/api-keys/new/values'] = [
        'name' => $name,
        'expires' => $expires,
        'invitation_access' => $invitation_access,
        'user_access' => $user_access,
    ];
    redirect();
}

include_once '../fns/parse_read_write.php';
parse_read_write($invitation_access,
    $can_read_invitations, $can_write_invitations);
parse_read_write($user_access, $can_read_users, $can_write_users);

include_once "$fnsDir/AdminApiKeys/add.php";
$id = AdminApiKeys\add($mysqli, $name, $expire_time, $can_read_invitations,
    $can_read_users, $can_write_invitations, $can_write_users);

unset(
    $_SESSION['admin/api-keys/new/errors'],
    $_SESSION['admin/api-keys/new/values']
);

$_SESSION['admin/api-keys/view/messages'] = [
    'Admin API key has been generated.',
];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
