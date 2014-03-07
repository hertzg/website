<?php

include_once '../../fns/require_user.php';
require_user('../../');

unset($_SESSION['contacts/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete all the contacts?');

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Delete All Contacts?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Contacts',
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all contacts', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    )
);
