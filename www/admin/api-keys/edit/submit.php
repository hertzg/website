<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id) = require_admin_api_key($mysqli);

include_once '../fns/request_admin_api_key_params.php';
list($name, $expires, $expire_time, $invitation_access,
    $user_access) = request_admin_api_key_params($mysqli, $errors, $id);

include_once "$fnsDir/request_strings.php";
list($randomizeKey) = request_strings('randomizeKey');

$randomizeKey = (bool)$randomizeKey;

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/api-keys/edit/errors'] = $errors;
    $_SESSION['admin/api-keys/edit/values'] = [
        'name' => $name,
        'expires' => $expires,
        'randomizeKey' => $randomizeKey,
        'invitation_access' => $invitation_access,
        'user_access' => $user_access,
    ];
    redirect("./$itemQuery");
}

include_once '../fns/parse_read_write.php';
parse_read_write($invitation_access,
    $can_read_invitations, $can_write_invitations);
parse_read_write($user_access, $can_read_users, $can_write_users);

include_once "$fnsDir/AdminApiKeys/edit.php";
AdminApiKeys\edit($mysqli, $id, $name, $expire_time, $can_read_invitations,
    $can_read_users, $can_write_invitations, $can_write_users);

if ($name !== $apiKey->name) {

    include_once "$fnsDir/Invitations/editApiKey.php";
    \Invitations\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Users/editApiKey.php";
    \Users\editApiKey($mysqli, $id, $name);

}

if ($randomizeKey) {
    include_once "$fnsDir/AdminApiKeys/randomizeKey.php";
    AdminApiKeys\randomizeKey($mysqli, $id);
}

unset(
    $_SESSION['admin/api-keys/edit/errors'],
    $_SESSION['admin/api-keys/edit/values']
);

$_SESSION['admin/api-keys/view/messages'] = ['Changes have been saved.'];

redirect("../view/$itemQuery");
