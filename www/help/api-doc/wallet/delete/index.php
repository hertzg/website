<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/wallet_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
wallet_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to delete.',
    ],
], ApiDoc\trueResult(), [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
