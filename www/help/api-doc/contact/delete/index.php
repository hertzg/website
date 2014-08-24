<?php

include_once '../fns/contact_method_page.php';
contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to delete.',
    ],
], [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
]);
