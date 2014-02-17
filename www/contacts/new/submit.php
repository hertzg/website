<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Tags.php';
include_once '../../lib/mysqli.php';

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
    if (Contacts\getByFullName($mysqli, $idusers, $fullname)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

if ($errors) {
    $_SESSION['contacts/new/index_errors'] = $errors;
    $_SESSION['contacts/new/index_lastpost'] = array(
        'fullname' => $fullname,
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
$id = Contacts\add($mysqli, $idusers, $fullname, $address,
    $email, $phone1, $phone2, $tags);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $idusers, $id, $tagnames, $fullname);

$_SESSION['contacts/view/index_messages'] = array('Contact has been saved.');
redirect("../view/?id=$id");
