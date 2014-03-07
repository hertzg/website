<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

unset($_SESSION['contacts/view/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to delete the contact'
    .' "<b>'.htmlspecialchars($contact->fullname).'</b>"?'
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Contact #$id?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Contacts',
                'href' => '..',
            ),
        ),
        "Contact #$id",
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete contact', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
