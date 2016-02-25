<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_contact_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received contact to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_CONTACT_NOT_FOUND' =>
        "A received contact with the ID doesn't exist.",
]);
