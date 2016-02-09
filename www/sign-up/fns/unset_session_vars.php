<?php

function unset_session_vars () {
    unset(
        $_SESSION['sign-in/errors'],
        $_SESSION['sign-in/messages'],
        $_SESSION['sign-in/values']
    );
}
