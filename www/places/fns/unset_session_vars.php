<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['places/new/errors'],
        $_SESSION['places/new/values'],
        $_SESSION['places/received/errors'],
        $_SESSION['places/received/messages'],
        $_SESSION['places/view/messages']
    );
}
