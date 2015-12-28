<?php

namespace ViewPage;

function theirExchangeApiKeyField ($connection) {

    $fnsDir = __DIR__.'/../../../../fns';
    $label = 'Their key';

    $their_exchange_api_key = $connection->their_exchange_api_key;
    if ($their_exchange_api_key === null) {
        include_once "$fnsDir/Form/label.php";
        return \Form\label($label, 'Not set');
    }

    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textarea.php";
    return
        \Form\textarea('their_exchange_api_key', $label, [
            'value' => $their_exchange_api_key,
            'readonly' => true,
        ])
        .\Form\notes([
            'This should be the value of <code>exchange_api_key</code>'
            .' parameter when we call their exchange API method.',
        ]);

}
