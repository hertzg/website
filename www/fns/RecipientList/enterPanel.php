<?php

namespace RecipientList;

function enterPanel ($username, array $params) {

    include_once __DIR__.'/enterForm.php';
    $enterForm = enterForm($username, $params, false);

    include_once __DIR__.'/../create_panel.php';
    return create_panel('Add somebody else', $enterForm);

}
