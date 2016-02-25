<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

include_once '../../../fns/request_files.php';
list($file) = request_files('file');

$errors = [];

$error = $file['error'];
if ($error === UPLOAD_ERR_OK) {
    $content = file_get_contents($file['tmp_name']);
    $image = @imagecreatefromstring($content);
    if ($image === false) $errors[] = 'Failed to open the photo file.';
} elseif ($error === UPLOAD_ERR_NO_FILE) {
    $errors[] = 'Select photo file.';
} else {
    $errors[] = 'Failed to upload the photo file.';
}

include_once '../../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/photo/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

include_once '../../../fns/Users/Contacts/Photo/set.php';
Users\Contacts\Photo\set($mysqli, $contact, $image);

unset($_SESSION['contacts/photo/edit/errors']);
$_SESSION['contacts/view/messages'] = ['The photo has been uploaded.'];
redirect("../../view/$itemQuery");
