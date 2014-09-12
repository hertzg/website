<?php

namespace Users\Contacts\Photo;

function delete ($mysqli, $contact) {
    $photo_id = $contact->photo_id;
    if ($photo_id) {

        include_once __DIR__.'/../../../Contacts/deletePhoto.php';
        \Contacts\deletePhoto($mysqli, $contact->id_contacts);

        include_once __DIR__.'/../../../ContactPhotos/delete.php';
        \ContactPhotos\delete($mysqli, $photo_id);

    }
}
