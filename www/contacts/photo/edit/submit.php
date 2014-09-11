<?php

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
    if (!$image) $errors[] = 'Failed to open the photo file.';
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

$width = imagesx($image);
$height = imagesy($image);
$photoSize = 165;
$destImage = imagecreatetruecolor($photoSize, $photoSize);

if ($width < $height) {
    $destWidth = $photoSize;
    $destHeight = $height * $photoSize / $width;
} else {
    $destWidth = $width * $photoSize / $height;
    $destHeight = $photoSize;
}

$x = ($photoSize - $destWidth) / 2;
$y = ($photoSize - $destHeight) / 2;

imagecopyresampled($destImage, $image, $x, $y, 0, 0,
    $destWidth, $destHeight, $width, $height);
ob_start();
imagepng($destImage);
$photoData = ob_get_clean();

include_once '../../../fns/ContactPhotos/add.php';
$photo_id = ContactPhotos\add($mysqli, $photoData);

include_once '../../../fns/Contacts/editPhoto.php';
Contacts\editPhoto($mysqli, $id, $photo_id);

$old_photo_id = $contact->photo_id;
if ($old_photo_id) {
    include_once '../../../fns/ContactPhotos/delete.php';
    ContactPhotos\delete($mysqli, $old_photo_id);
}

unset($_SESSION['contacts/photo/edit/errors']);
$_SESSION['contacts/view/messages'] = ['The photo has been uploaded.'];
redirect("../../view/$itemQuery");
