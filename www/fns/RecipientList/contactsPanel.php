<?php

namespace RecipientList;

function contactsPanel ($username, $params,
    $base, $contactsBase, $localBase = '') {

    include_once __DIR__.'/contactsForm.php';
    $contactsForm = contactsForm($username,
        $params, $base, $contactsBase, $localBase);

    include_once __DIR__.'/../Page/panel.php';
    return \Page\panel('Add more from contacts', $contactsForm);

}
