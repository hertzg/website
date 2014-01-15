<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-contact.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Contacts.php';
include_once '../classes/Tags.php';

list($fullname, $address, $email, $phone1, $phone2, $tags) = request_strings(
    'fullname', 'address', 'email', 'phone1', 'phone2', 'tags');

$fullname = str_collapse_spaces($fullname);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($fullname === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($fullname, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} elseif (Contacts::getByFullName($idusers, $fullname, $id)) {
    $errors[] = 'A contact with this name already exists.';
}

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

if ($errors) {
    $_SESSION['contacts/edit_errors'] = $errors;
    $_SESSION['contacts/edit_lastpost'] = array(
        'fullname' => $fullname,
        'address' => $address,
        'email' => $email,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'tags' => $tags,
    );
    redirect("edit.php?id=$id");
}

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost']
);

Contacts::edit($idusers, $id, $fullname, $address,
    $email, $phone1, $phone2, $tags);

include_once '../classes/ContactTags.php';
ContactTags::deleteOnContact($id);
ContactTags::add($idusers, $id, $tagnames);

$_SESSION['contacts/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
