<?php

namespace Users\Contacts\Photo;

function set ($mysqli, $contact, $image) {

    $fnsDir = __DIR__.'/../../..';

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

    include_once "$fnsDir/ContactPhotos/add.php";
    $photo_id = \ContactPhotos\add($mysqli, $photoData);

    include_once "$fnsDir/Contacts/editPhoto.php";
    \Contacts\editPhoto($mysqli, $contact->id, $photo_id);

    $old_photo_id = $contact->photo_id;
    if ($old_photo_id) {
        include_once "$fnsDir/ContactPhotos/delete.php";
        \ContactPhotos\delete($mysqli, $old_photo_id);
    }

    if ($contact->num_tags) {
        include_once "$fnsDir/ContactTags/editContactPhoto.php";
        \ContactTags\editContactPhoto($mysqli, $contact->id, $photo_id);
    }

}
