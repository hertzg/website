<?php

function unset_session_vars () {
    unset(
        $_SESSION['email-reset-password/errors'],
        $_SESSION['email-reset-password/values'],
        $_SESSION['sign-up/errors'],
        $_SESSION['sign-up/values']
    );
}
