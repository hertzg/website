<?php

function unset_session_vars () {
    unset(
        $_SESSION['files/add-folder/errors'],
        $_SESSION['files/add-folder/values'],
        $_SESSION['files/rename-folder/errors'],
        $_SESSION['files/rename-folder/values'],
        $_SESSION['files/upload-files/errors'],
        $_SESSION['files/view-file/messages'],
        $_SESSION['home/messages']
    );
}
