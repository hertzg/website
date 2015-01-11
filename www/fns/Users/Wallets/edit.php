<?php

namespace Users\Wallets;

function edit ($mysqli, $id, $name) {
    include_once __DIR__.'/../../Wallets/edit.php';
    \Wallets\edit($mysqli, $id, $name);
}
