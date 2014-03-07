<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

include_once '../../fns/request_strings.php';
list($fullname, $address, $email, $phone1, $phone2, $tags) = request_strings(
    'fullname', 'address', 'email', 'phone1', 'phone2', 'tags');

include_once '../../fns/str_collapse_spaces.php';
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
} else {
    include_once '../../fns/Contacts/getByFullName.php';
    if (Contacts\getByFullName($mysqli, $idusers, $fullname, $id)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tagnames, $errors);

include_once '../../fns/redirect.php';

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
    redirect("./?id=$id");
}

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost']
);

include_once '../../fns/Contacts/edit.php';
Contacts\edit($mysqli, $idusers, $id, $fullname, $address,
    $email, $phone1, $phone2, $tags);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $idusers, $id, $tagnames, $fullname);

$_SESSION['contacts/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
