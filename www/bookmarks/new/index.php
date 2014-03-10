<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

if (array_key_exists('bookmarks/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['bookmarks/new/index_lastpost'];
} else {
    $values = array(
        'url' => '',
        'title' => '',
        'tags' => '',
    );
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('bookmarks/new/index_errors');

unset($_SESSION['bookmarks/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Bookmarks',
                'href' => '..',
            ),
        ),
        'New',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('url', 'URL', array(
                'value' => $values['url'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('title', 'Title', array(
                'value' => $values['title'],
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
echo_page($user, 'New Bookmark', $content, '../../');
