<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
$content =
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
        Page\text(
            'Are you sure you want to delete the contact'
            .' "<b>'.htmlspecialchars($contact->full_name).'</b>"?'
        )
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete contact', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Contact #$id?", $content, '../../');
