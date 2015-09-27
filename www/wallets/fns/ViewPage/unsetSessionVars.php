<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['wallets/all-transactions/messages'],
        $_SESSION['wallets/edit/errors'],
        $_SESSION['wallets/edit/values'],
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages'],
        $_SESSION['wallets/new/errors'],
        $_SESSION['wallets/new/values'],
        $_SESSION['wallets/new-transaction/errors'],
        $_SESSION['wallets/new-transaction/values'],
        $_SESSION['wallets/transfer-amount/errors'],
        $_SESSION['wallets/transfer-amount/values'],
        $_SESSION['wallets/view-transaction/messages']
    );
}
