<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/messages'],
        $_SESSION['admin/users/new/errors'],
        $_SESSION['admin/users/new/values'],
        $_SESSION['admin/users/view/messages']
    );
}
