<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/connections/index_errors'],
        $_SESSION['account/connections/index_messages'],
        $_SESSION['account/verify-email/index_errors'],
        $_SESSION['change-password/index_errors'],
        $_SESSION['change-password/index_values'],
        $_SESSION['close-account/index_errors'],
        $_SESSION['edit-profile/index_errors'],
        $_SESSION['edit-profile/index_values'],
        $_SESSION['home/index_messages'],
        $_SESSION['tokens/index_messages']
    );
}
