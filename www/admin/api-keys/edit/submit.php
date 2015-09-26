<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id) = require_admin_api_key($mysqli);

include_once '../fns/request_admin_api_key_params.php';
list($name) = request_admin_api_key_params($mysqli, $errors, $id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/api-keys/edit/errors'] = $errors;
    $_SESSION['admin/api-keys/edit/values'] = ['name' => $name];
    redirect("./?id=$id");
}

unset(
    $_SESSION['admin/api-keys/edit/errors'],
    $_SESSION['admin/api-keys/edit/values']
);

include_once "$fnsDir/AdminApiKeys/edit.php";
AdminApiKeys\edit($mysqli, $id, $name);

$_SESSION['admin/api-keys/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
