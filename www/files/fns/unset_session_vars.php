<?php

function unset_session_vars () {
    unset(
        $_SESSION['files/new-folder/errors'],
        $_SESSION['files/new-folder/values'],
        $_SESSION['files/received/errors'],
        $_SESSION['files/received/messages'],
        $_SESSION['files/rename-folder/errors'],
        $_SESSION['files/rename-folder/values'],
        $_SESSION['files/send-folder/errors'],
        $_SESSION['files/send-folder/messages'],
        $_SESSION['files/send-folder/values'],
        $_SESSION['files/upload-files/errors'],
        $_SESSION['files/view-file/errors'],
        $_SESSION['files/view-file/messages'],
        $_SESSION['home/messages']
    );
}
