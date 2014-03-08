<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

if (array_key_exists('channels/add_lastpost', $_SESSION)) {
    $values = $_SESSION['channels/add_lastpost'];
} else {
    $values = array('channelname' => '');
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('channels/add_errors');

unset($_SESSION['channels/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/notes.php';
include_once '../../fns/Form/textfield.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ),
            array(
                'title' => 'Channels',
                'href' => '..',
            ),
        ),
        'New',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('channelname', 'Channel name', array(
                'value' => $values['channelname'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ))
            .Form\notes(array(
                'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
                'Minimum 6 maximum 32 characters.',
            ))
            .'<div class="hr"></div>'
            .Form\button('Create')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Channel', $content, '../../');
