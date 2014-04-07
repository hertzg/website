<?php

function unset_session_vars () {
    unset(
        $_SESSION['files/new-folder/errors'],
        $_SESSION['files/new-folder/values'],
        $_SESSION['files/rename-folder/errors'],
        $_SESSION['files/rename-folder/values'],
        $_SESSION['files/upload-files/errors'],
        $_SESSION['files/view-file/messages'],
        $_SESSION['home/messages']
    );
}
