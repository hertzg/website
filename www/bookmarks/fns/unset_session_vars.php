<?php

function unset_session_vars () {
    unset(
        $_SESSION['bookmarks/new/errors'],
        $_SESSION['bookmarks/new/values'],
        $_SESSION['bookmarks/received/errors'],
        $_SESSION['bookmarks/received/messages'],
        $_SESSION['bookmarks/view/messages'],
        $_SESSION['home/messages']
    );
}
