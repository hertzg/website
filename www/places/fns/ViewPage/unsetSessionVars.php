<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['places/new-point/errors'],
        $_SESSION['places/new-point/values'],
        $_SESSION['places/edit/errors'],
        $_SESSION['places/edit/values'],
        $_SESSION['places/errors'],
        $_SESSION['places/messages'],
        $_SESSION['places/send/errors'],
        $_SESSION['places/send/messages'],
        $_SESSION['places/send/values'],
        $_SESSION['places/view-point/messages']
    );
}
