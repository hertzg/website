<?php

include_once '../fns/contact_photo_method_page.php';
contact_photo_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to delete the photo of.',
    ],
], [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
    'NO_PHOTO' => "The contact doesn't have a photo.",
]);
