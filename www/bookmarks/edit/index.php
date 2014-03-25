<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

if (array_key_exists('bookmarks/edit/index_values', $_SESSION)) {
    $values = $_SESSION['bookmarks/edit/index_values'];
} else {
    $values = (array)$bookmark;
}

unset(
    $_SESSION['bookmarks/index_errors'],
    $_SESSION['bookmarks/index_messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => "Bookmark #$id",
                'href' => "../view/?id=$id",
            ),
        ),
        'Edit',
        Page\sessionErrors('bookmarks/edit/index_errors')
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
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Bookmark #$id", $content, '../../');
