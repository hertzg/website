<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/request_strings.php';
list($text) = request_strings('text');

include_once '../../fns/str_collapse_spaces.php';
$text = str_collapse_spaces($text);

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    $_SESSION['schedules/edit/values'] = [
        'text' => $text,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['schedules/edit/errors'],
    $_SESSION['schedules/edit/values']
);

include_once '../../fns/Schedules/edit.php';
Schedules\edit($mysqli, $id, $text);

$_SESSION['schedules/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
