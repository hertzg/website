<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

unset($_SESSION['bookmarks/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete all the bookmarks?');

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Bookmarks',
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all bookmarks', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Bookmarks?', $content, '../../');
