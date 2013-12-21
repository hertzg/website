<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-contact.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Contacts.php';

list($fullname, $address, $email, $phone1, $phone2) = request_strings(
    'fullname', 'address', 'email', 'phone1', 'phone2');

$fullname = str_collapse_spaces($fullname);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);

$errors = array();

if ($fullname === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($fullname, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} elseif (Contacts::getByFullName($idusers, $fullname, $id)) {
    $errors[] = 'A contact with this name already exists.';
}

unset($_SESSION['contacts/edit_errors']);

if ($errors) {
    $_SESSION['contacts/edit_errors'] = $errors;
    $_SESSION['contacts/edit_lastpost'] = $_POST;
    redirect("edit.php?id=$id");
}

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost']
);

Contacts::edit($idusers, $id, $fullname, $address, $email, $phone1, $phone2);

$_SESSION['contacts/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
