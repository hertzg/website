<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['account/api-keys/edit/errors'],
        $_SESSION['account/api-keys/edit/values'],
        $_SESSION['account/api-keys/errors'],
        $_SESSION['account/api-keys/messages'],
        $_SESSION['account/api-keys/new/errors'],
        $_SESSION['account/api-keys/new/values']
    );
}
