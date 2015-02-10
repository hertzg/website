<?php

function unset_session_vars () {
    unset(
        $_SESSION['bookmarks/view/messages'],
        $_SESSION['contacts/view/messages'],
        $_SESSION['files/view-file/errors'],
        $_SESSION['files/view-file/messages'],
        $_SESSION['files/errors'],
        $_SESSION['files/id_folders'],
        $_SESSION['files/messages'],
        $_SESSION['home/messages'],
        $_SESSION['notes/view/messages'],
        $_SESSION['places/view/messages'],
        $_SESSION['tasks/view/messages']
    );
}
