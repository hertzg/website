<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['admin/api-keys/edit/errors'],
        $_SESSION['admin/api-keys/edit/values'],
        $_SESSION['admin/api-keys/errors'],
        $_SESSION['admin/api-keys/messages'],
        $_SESSION['admin/api-keys/new/errors'],
        $_SESSION['admin/api-keys/new/values']
    );
}
