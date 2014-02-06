<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once '../lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Users.php';

list($email, $fullname) = request_strings('email', 'fullname');

$fullname = str_collapse_spaces($fullname);

$errors = array();

$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');
if ($email === '') {
    $errors[] = 'Enter email.';
} else {
    include_once '../fns/is_email_valid.php';
    if (!is_email_valid($email)) {
        $errors[] = 'Enter a valid email address.';
    } else if (Users::getByEmail($email, $idusers)) {
        $errors[] = 'A username with this email is already registered. Try another.';
    }
}

if ($errors) {
    $_SESSION['edit-profile/index_errors'] = $errors;
    $_SESSION['edit-profile/index_lastpost'] = array(
        'email' => $email,
        'fullname' => $fullname,
    );
    redirect();
}

unset(
    $_SESSION['edit-profile/index_errors'],
    $_SESSION['edit-profile/index_lastpost']
);

Users::editProfile($idusers, $email, $fullname);

$_SESSION['account/index_messages'] = array('Changes have been saved.');

redirect('../account/');
