<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/messages'],
        $_SESSION['admin/connections/new/errors'],
        $_SESSION['admin/connections/new/values'],
        $_SESSION['admin/connections/view/errors'],
        $_SESSION['admin/connections/view/messages']
    );
}
