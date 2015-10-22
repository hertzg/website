<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/api-keys/errors'],
        $_SESSION['admin/api-keys/messages'],
        $_SESSION['admin/general-info/messages'],
        $_SESSION['admin/invitations/errors'],
        $_SESSION['admin/invitations/messages'],
        $_SESSION['admin/mysql-settings/messages'],
        $_SESSION['admin/username-password/errors'],
        $_SESSION['admin/username-password/values'],
        $_SESSION['admin/users/errors'],
        $_SESSION['admin/users/messages']
    );
}
