<?php

function wallet_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/wallet/get_methods.php";
    $description = wallet\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Wallet', 'wallet', $methodName,
        $description, $params, $returns, $errors);

}
