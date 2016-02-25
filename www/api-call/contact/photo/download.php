<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('contact/photo/download',
    'can_read_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact_with_photo.php';
$contact = require_contact_with_photo($mysqli, $user);

include_once '../../../fns/ContactPhotos/path.php';
$path = ContactPhotos\path($contact->photo_id);

header('Content-Type: image/png');
readfile($path);
