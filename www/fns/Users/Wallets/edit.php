<?php

namespace Users\Wallets;

function edit ($mysqli, $id, $name, $updateApiKey = null) {
    include_once __DIR__.'/../../Wallets/edit.php';
    \Wallets\edit($mysqli, $id, $name, $updateApiKey);
}
