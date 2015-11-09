<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/api-keys/new/errors'],
        $_SESSION['account/api-keys/new/values'],
        $_SESSION['account/api-keys/view/messages'],
        $_SESSION['account/messages']
    );
}
