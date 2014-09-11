<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

$photo_id = $contact->photo_id;

if ($photo_id) {

    include_once '../../../fns/Contacts/deletePhoto.php';
    Contacts\deletePhoto($mysqli, $id);

    include_once '../../../fns/ContactPhotos/delete.php';
    ContactPhotos\delete($mysqli, $photo_id);

}

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/itemQuery.php';
redirect('../../view/'.ItemList\itemQuery($id));
