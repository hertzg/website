<?php

function transaction_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/wallet/transaction/get_methods.php";
    $description = wallet\transaction\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('wallet', 'Transaction', 'transaction',
        $methodName, $description, $params, $errors);

}
