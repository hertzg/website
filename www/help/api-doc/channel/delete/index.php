<?php

include_once '../fns/channel_method_page.php';
include_once '../../fns/true_result.php';
channel_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to delete.',
    ],
], true_result(), [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
]);
