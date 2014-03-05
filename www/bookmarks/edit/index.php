<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('bookmarks/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['bookmarks/edit_lastpost'];
} else {
    $values = (array)$bookmark;
}

if (array_key_exists('bookmarks/edit_errors', $_SESSION)) {
    include_once '../../fns/Page/errors.php';
    $pageErrors = Page\errors($_SESSION['bookmarks/edit_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['bookmarks/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Bookmark #$id";
$page->finish(
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
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textfield('url', 'URL', array(
                'value' => $values['url'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('title', 'Title', array(
                'value' => $values['title'],
            ))
            .Page::HR
            .Form::textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .Page::HR
            .Form::button('Save Changes')
            .Form::hidden('id', $id)
        )
    )
);
