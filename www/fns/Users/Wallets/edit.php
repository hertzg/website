<?php

namespace Users\Wallets;

function edit ($mysqli, $wallet, $name, &$changed, $updateApiKey = null) {

    if ($wallet->name === $name) return;

    $changed = true;

    include_once __DIR__.'/../../Wallets/edit.php';
    \Wallets\edit($mysqli, $wallet->id, $name, $updateApiKey);

}
