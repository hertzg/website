<?php

include_once '../fns/contact_method_page.php';
contact_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to delete.',
    ],
]);
