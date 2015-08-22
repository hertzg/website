<?php

include_once '../fns/contact_method_page.php';
include_once '../../fns/true_result.php';
contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to delete.',
    ],
], true_result(), [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
]);
