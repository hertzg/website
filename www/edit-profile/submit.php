<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/request_strings.php';
list($email, $fullname) = request_strings('email', 'fullname');

include_once '../fns/str_collapse_spaces.php';
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
    } else {
        include_once '../fns/Users/getByEmail.php';
        include_once '../lib/mysqli.php';
        if (Users\getByEmail($mysqli, $email, $idusers)) {
            $errors[] = 'A username with this email is already registered. Try another.';
        }
    }
}

include_once '../fns/redirect.php';

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

include_once '../fns/Users/editProfile.php';
Users\editProfile($mysqli, $idusers, $email, $fullname);

if ($email !== $user->email) {
    include_once '../fns/Users/invalidateEmail.php';
    Users\invalidateEmail($mysqli, $idusers);
}

$_SESSION['account/index_messages'] = array('Changes have been saved.');

redirect('../account/');
