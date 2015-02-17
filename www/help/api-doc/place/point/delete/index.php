<?php

include_once '../fns/place_point_method_page.php';
place_point_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the point to delete.',
    ],
], [
    'POINT_NOT_FOUND' => "A point with the ID doesn't exist.",
]);
