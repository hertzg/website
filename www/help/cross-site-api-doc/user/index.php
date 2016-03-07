<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/method_page.php';
include_once '../../../fns/Tags/maxNumber.php';
method_page('user', [], [
    'type' => 'number',
    'description' => 'The ID of the current user.',
], []);
