<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/channel_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
channel_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to delete.',
    ],
], ApiDoc\trueResult(), [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
]);
