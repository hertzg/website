<?php

function unset_session_vars () {
    unset(
        $_SESSION['sign-in/errors'],
        $_SESSION['sign-in/values'],
        $_SESSION['sign-in/messages'],
        $_SESSION['sign-up/errors'],
        $_SESSION['sign-up/values']
    );
}
