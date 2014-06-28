<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/request_strings.php';
list($feedbacktext) = request_strings('feedbacktext');

$errors = [];

include_once '../../fns/str_collapse_spaces.php';
$feedbacktext = str_collapse_spaces($feedbacktext);

if ($feedbacktext === '') {
    $errors[] = 'Enter feedback text.';
} elseif (count(explode(' ', $feedbacktext)) < 6) {
    $errors[] = 'Feedback text too short. At least 6 words required.';
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['help/feedback/errors'] = $errors;
    $_SESSION['help/feedback/values'] = [
        'feedbacktext' => $feedbacktext,
    ];
    redirect();
}

unset(
    $_SESSION['help/feedback/errors'],
    $_SESSION['help/feedback/values']
);

include_once '../../fns/Feedbacks/add.php';
include_once '../../lib/mysqli.php';
$id = Feedbacks\add($mysqli, $user->id_users, $feedbacktext);

$title = "Zvini Feedback #$id";

$html =
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
        .'</head>'
        .'<body>'
            .htmlspecialchars($feedbacktext)
        .'</body>'
    .'</html>';

$subject = mb_encode_mimeheader($title, 'UTF-8');

$headers =
    "From: no-reply@zvini.com\r\n"
    ."Reply-To: $user->email\r\n"
    .'Content-Type: text/html; charset=UTF-8';

mail('info@zvini.com', $title, $html, $headers);

$_SESSION['help/messages'] = ['Thank you for the feedback.'];

session_commit();

include_once '../../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-feedbacks',
    'text' => $feedbacktext,
]);

redirect('..');
