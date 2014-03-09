<?php

include_once '../../fns/require_user.php';
require_user('../../');

if (array_key_exists('notes/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['notes/new/index_lastpost'];
} else {
    $values = array(
        'notetext' => '',
        'tags' => '',
    );
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('notes/new/index_errors');

unset($_SESSION['notes/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Notes',
                'href' => '..',
            ),
        ),
        'New',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textarea('notetext', 'Text', array(
                'value' => $values['notetext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .'<div class="hr"></div>'
            .Form\button('Save')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Note', $content, '../../');
