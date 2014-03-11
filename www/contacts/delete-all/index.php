<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['contacts/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Contacts',
        Page\text('Are you sure you want to delete all the contacts?')
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all contacts', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Contacts?', $content, $base);
