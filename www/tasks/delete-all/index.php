<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete all the tasks?');

unset($_SESSION['tasks/index_messages']);

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
        'Tasks',
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all task', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Tasks?', $content, '../../');
