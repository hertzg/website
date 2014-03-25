<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/connections/errors'],
        $_SESSION['account/connections/messages'],
        $_SESSION['account/verify-email/errors'],
        $_SESSION['change-password/errors'],
        $_SESSION['change-password/values'],
        $_SESSION['close-account/errors'],
        $_SESSION['edit-profile/errors'],
        $_SESSION['edit-profile/values'],
        $_SESSION['home/messages'],
        $_SESSION['tokens/messages']
    );
}
