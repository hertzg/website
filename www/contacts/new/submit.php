<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../lib/mysqli.php';

include_once '../../fns/request_strings.php';
list($full_name, $alias, $address, $email,
    $phone1, $phone2, $tags) = request_strings(
    'full_name', 'alias', 'address', 'email',
    'phone1', 'phone2', 'tags');

include_once '../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);
$alias = str_collapse_spaces($alias);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($full_name === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($full_name, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} else {
    include_once '../../fns/Contacts/getByFullName.php';
    if (Contacts\getByFullName($mysqli, $idusers, $full_name)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tagnames, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/new/index_errors'] = $errors;
    $_SESSION['contacts/new/index_lastpost'] = array(
        'full_name' => $full_name,
        'alias' => $alias,
        'address' => $address,
        'email' => $email,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'tags' => $tags,
    );
    redirect();
}

unset(
    $_SESSION['contacts/new/index_errors'],
    $_SESSION['contacts/new/index_lastpost']
);

include_once '../../fns/Contacts/add.php';
$id = Contacts\add($mysqli, $idusers, $full_name, $alias,
    $address, $email, $phone1, $phone2, $tags);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $idusers, $id, $tagnames, $full_name, $alias);

include_once '../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $idusers, 1);

$_SESSION['contacts/view/index_messages'] = array('Contact has been saved.');
redirect("../view/?id=$id");
