<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/api-keys/errors'],
        $_SESSION['account/api-keys/messages'],
        $_SESSION['account/change-password/errors'],
        $_SESSION['account/change-password/values'],
        $_SESSION['account/close/errors'],
        $_SESSION['account/connections/errors'],
        $_SESSION['account/connections/messages'],
        $_SESSION['account/edit-profile/errors'],
        $_SESSION['account/edit-profile/values'],
        $_SESSION['account/verify-email/errors'],
        $_SESSION['home/messages'],
        $_SESSION['tokens/errors'],
        $_SESSION['tokens/messages']
    );
}
