<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($name, $expires) = request_strings('name', 'expires');

include_once '../../../fns/str_collapse_spaces.php';
$name = str_collapse_spaces($name);

$errors = [];

if ($name === '') $errors[] = 'Enter name.';
else {
    include_once '../../../fns/ApiKeys/getOnUserByName.php';
    include_once '../../../lib/mysqli.php';
    $apiKey = ApiKeys\getOnUserByName($mysqli, $id_users, $name);
    if ($apiKey) {
        $errors[] = 'An API key with this name already exists.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/api-keys/new/errors'] = $errors;
    $_SESSION['account/api-keys/new/values'] = [
        'name' => $name,
        'expires' => $expires,
    ];
    redirect();
}

unset(
    $_SESSION['account/api-keys/new/errors'],
    $_SESSION['account/api-keys/new/values']
);

include_once '../../../fns/Users/ApiKeys/add.php';
$id = Users\ApiKeys\add($mysqli, $id_users, $name);

$_SESSION['account/api-keys/view/messages'] = ['API key has been generated.'];

redirect("../view/?id=$id");
