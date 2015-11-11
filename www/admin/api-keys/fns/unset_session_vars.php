<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/messages'],
        $_SESSION['admin/api-keys/new/errors'],
        $_SESSION['admin/api-keys/new/values'],
        $_SESSION['admin/api-keys/view/messages']
    );
}
