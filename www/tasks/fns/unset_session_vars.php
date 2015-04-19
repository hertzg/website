<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['tasks/new/errors'],
        $_SESSION['tasks/new/values'],
        $_SESSION['tasks/received/errors'],
        $_SESSION['tasks/received/messages'],
        $_SESSION['tasks/view/messages']
    );
}
