<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

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
$id = Feedbacks\add($mysqli, $idusers, $feedbacktext);

include_once '../../classes/ZviniAPI.php';
ZviniAPI::notify('zvini-feedbacks', '58ff602ff1c79d81ca43d51f59ca03bd', $feedbacktext);

$title = "Zvini Feedback #$id";

$html =
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
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
redirect('..');
