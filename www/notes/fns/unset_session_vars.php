<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['notes/new/errors'],
        $_SESSION['notes/new/values'],
        $_SESSION['notes/received/messages'],
        $_SESSION['notes/view/messages']
    );
}
