<?php

namespace RecipientList;

function contactsPanel ($username, array $params) {
    include_once __DIR__.'/contactsForm.php';
    include_once __DIR__.'/../create_panel.php';
    return create_panel('Add from Contacts', contactsForm($username, $params));
}
