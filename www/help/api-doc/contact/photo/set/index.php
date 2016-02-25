<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/contact_photo_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
contact_photo_method_page('set', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to set the photo of.',
    ],
    [
        'name' => 'file',
        'description' => 'The photo file to upload.',
    ],
], ApiDoc\trueResult(), [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
    'SELECT_FILE' => 'The photo file is empty.',
    'INVALID_PHOTO' => "The photo couldn't be opened.",
    'FILE_ERROR' => 'An error occured while uploading the file.',
]);
