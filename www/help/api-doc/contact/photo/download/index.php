<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/contact_photo_method_page.php';
contact_photo_method_page('download', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to download the photo of.',
    ],
], [
    'type' => 'binary',
    'description' => 'the photo in PNG format.',
], [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
    'NO_PHOTO' => "The contact doesn't have a photo.",
]);
