<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Schedules/request.php';
list($text, $time_interval, $time_offset) = Schedules\request();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/new/errors'] = $errors;
    $_SESSION['schedules/new/values'] = [
        'text' => $text,
        'time_interval' => $time_interval,
        'time_offset' => $time_offset,
    ];
    redirect();
}

unset(
    $_SESSION['schedules/new/errors'],
    $_SESSION['schedules/new/values']
);

include_once '../../fns/Schedules/add.php';
include_once '../../lib/mysqli.php';
$id = Schedules\add($mysqli, $user->id_users, $text);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

redirect("../view/?id=$id");
