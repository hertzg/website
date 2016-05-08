<?php

namespace Users\Contacts\Photo;

function delete ($mysqli, $contact) {
    $photo_id = $contact->photo_id;
    if ($photo_id) {

        $fnsDir = __DIR__.'/../../..';

        include_once "$fnsDir/Contacts/deletePhoto.php";
        \Contacts\deletePhoto($mysqli, $contact->id);

        include_once "$fnsDir/ContactPhotos/delete.php";
        \ContactPhotos\delete($mysqli, $photo_id);

        if ($contact->num_tags) {
            include_once "$fnsDir/ContactTags/deleteContactPhoto.php";
            \ContactTags\deleteContactPhoto($mysqli, $contact->id);
        }

    }
}
