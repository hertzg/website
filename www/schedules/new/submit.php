<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Schedules/requestFirstStage.php';
list($text, $day_interval) = Schedules\requestFirstStage();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

$_SESSION['schedules/new/values'] = [
    'text' => $text,
    'day_interval' => $day_interval,
];

if ($errors) {
    $_SESSION['schedules/new/errors'] = $errors;
    redirect();
}

unset($_SESSION['schedules/new/errors']);

$_SESSION['schedules/new/next/first_stage'] = [
    'text' => $text,
    'day_interval' => $day_interval,
];

 redirect('next/');
