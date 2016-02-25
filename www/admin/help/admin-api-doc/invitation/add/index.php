<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/invitation_method_page.php';
include_once '../../../../../fns/Tags/maxNumber.php';
invitation_method_page('add', [
    [
        'name' => 'note',
        'description' => 'The note of the invitation.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created invitation.',
], []);
