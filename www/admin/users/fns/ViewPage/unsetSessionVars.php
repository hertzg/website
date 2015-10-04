<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['admin/users/edit-profile/errors'],
        $_SESSION['admin/users/edit-profile/values'],
        $_SESSION['admin/users/errors'],
        $_SESSION['admin/users/messages'],
        $_SESSION['admin/users/new/errors'],
        $_SESSION['admin/users/new/values'],
        $_SESSION['admin/users/reset-password/errors'],
        $_SESSION['admin/users/reset-password/values']
    );
}
