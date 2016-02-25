<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/contact_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to delete.',
    ],
], ApiDoc\trueResult(), [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
]);
