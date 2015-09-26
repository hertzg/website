<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_admin.php';
require_admin();

include_once '../fns/request_admin_api_key_params.php';
list($name) = request_admin_api_key_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/api-keys/new/errors'] = $errors;
    $_SESSION['admin/api-keys/new/values'] = ['name' => $name];
    redirect();
}

unset(
    $_SESSION['admin/api-keys/new/errors'],
    $_SESSION['admin/api-keys/new/values']
);

include_once "$fnsDir/AdminApiKeys/add.php";
include_once '../../../lib/mysqli.php';
$id = AdminApiKeys\add($mysqli, $name);

$message = 'The admin API key has been generated.';
$_SESSION['admin/api-keys/view/messages'] = [$message];

redirect("../view/?id=$id");
