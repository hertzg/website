<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['wallets/new/errors'],
        $_SESSION['wallets/new/values'],
        $_SESSION['wallets/view/errors'],
        $_SESSION['wallets/view/messages'],
        $_SESSION['wallets/quick-new-transaction/errors'],
        $_SESSION['wallets/quick-new-transaction/values'],
        $_SESSION['wallets/quick-transfer-amount/errors'],
        $_SESSION['wallets/quick-transfer-amount/values']
    );
}
