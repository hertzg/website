<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/index_messages'],
        $_SESSION['notes/new/index_errors'],
        $_SESSION['notes/new/index_values'],
        $_SESSION['notes/view/index_messages']
    );
}
