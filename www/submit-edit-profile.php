<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';

list($email, $fullname) = request_strings('email', 'fullname');

$email = mb_strtolower($email, 'UTF-8');

$errors = array();

if (!$email) {
    $errors[] = 'Enter email.';
} elseif (!preg_match("/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*[a-z0-9]\.[a-z.]+$/", $email)) {
    $errors[] = 'Enter a valid email address.';
} else if (Users::getByEmail($email, $idusers)) {
    $errors[] = 'A username with this email is already registered. Try another.';
}

unset(
    $_SESSION['edit-profile_errors'],
    $_SESSION['edit-profile_lastpost']
);

if ($errors) {
    $_SESSION['edit-profile_errors'] = $errors;
    $_SESSION['edit-profile_lastpost'] = $_POST;
    redirect('edit-profile.php');
}

Users::editProfile($idusers, $email, $fullname);

$_SESSION['account_messages'] = array('Changes have been saved.');
redirect('account.php');
