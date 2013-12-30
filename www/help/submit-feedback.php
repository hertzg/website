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

Feedbacks::add($idusers, $feedbacktext);

ZviniAPI::notify('zvini-feedbacks', '58ff602ff1c79d81ca43d51f59ca03bd', $feedbacktext);

$_SESSION['help/index_messages'] = array('Thank you for the feedback.');
redirect();
