<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once '../lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Feedbacks.php';
include_once '../classes/ZviniAPI.php';

list($feedbacktext) = request_strings('feedbacktext');

$errors = array();

$feedbacktext = str_collapse_spaces($feedbacktext);

if ($feedbacktext === '') {
    $errors[] = 'Enter feedback text.';
} elseif (count(explode(' ', $feedbacktext)) < 6) {
    $errors[] = 'Feedback text too short. At least 6 words required.';
}

if ($errors) {
    $_SESSION['help/feedback_errors'] = $errors;
    $_SESSION['help/feedback_lastpost'] = array('feedbacktext' => $feedbacktext);
    redirect('feedback.php');
}

unset(
    $_SESSION['help/feedback_errors'],
    $_SESSION['help/feedback_lastpost']
);

$id = Feedbacks::add($idusers, $feedbacktext);

ZviniAPI::notify('zvini-feedbacks', '58ff602ff1c79d81ca43d51f59ca03bd', $feedbacktext);

$title = "Zvini Feedback #$id";

mail(
    'info@zvini.com',
    $title,
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
        .'</head>'
        .'<body>'
            .htmlspecialchars($feedbacktext)
        .'</body>'
    .'</html>',
    "From: no-reply@zvini.com\r\n"
    ."Reply-To: $user->email\r\n"
    .'Content-Type: text/html; charset=UTF-8'
);

$_SESSION['help/index_messages'] = array('Thank you for the feedback.');
redirect();
