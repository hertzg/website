<?php

function unset_session_vars () {
    unset(
        $_SESSION['bookmarks/new/index_errors'],
        $_SESSION['bookmarks/new/index_values'],
        $_SESSION['bookmarks/view/index_messages'],
        $_SESSION['home/index_messages']
    );
}
