<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages']
    );
}
