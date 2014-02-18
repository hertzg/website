<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

function createTagInput ($tag) {
    return '<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
}

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($keyword, $tag) = request_strings('keyword', 'tag');

$items = array();
$filterMessage = '';

if ($keyword === '') {
    if ($tag === '') {

        include_once '../fns/Notes/index.php';
        $notes = Notes\index($mysqli, $idusers);

        if (count($notes) > 1) {

            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(create_search_form_empty_content('Search notes...'));

            include_once '../fns/NoteTags/indexOnUser.php';
            $tags = NoteTags\indexOnUser($mysqli, $idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        include_once '../fns/NoteTags/indexOnTagName.php';
        $notes = NoteTags\indexOnTagName($mysqli, $idusers, $tag);

        if (count($notes) > 1) {
            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(
                create_search_form_empty_content('Search notes...')
                .createTagInput($tag)
            );
        }

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
} else {
    include_once '../fns/create_search_form_content.php';
    if ($tag === '') {

        include_once '../fns/Notes/search.php';
        $notes = Notes\search($mysqli, $idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search notes...', './')
        );
        if (count($notes) > 1) {

            include_once '../fns/NoteTags/indexOnUser.php';
            $tags = NoteTags\indexOnUser($mysqli, $idusers);

            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }

        }

    } else {

        include_once '../fns/NoteTags/searchOnTagName.php';
        $notes = NoteTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search notes...', '?tag='.rawurlencode($tag))
            .createTagInput($tag)
        );

        $clearHref = '?'.htmlspecialchars(
            http_build_query(array('keyword' => $keyword))
        );
        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

    }
}

if ($notes) {
    foreach ($notes as $note) {
        $items[] = Page::imageLink(
            htmlspecialchars($note->notetext),
            "view/?id=$note->idnotes",
            'note'
        );
    }
} else {
    $items[] = Page::info('No notes.');
}

if (array_key_exists('notes/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['notes/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['notes/new/index_errors'],
    $_SESSION['notes/new/index_lastpost'],
    $_SESSION['notes/view/index_messages']
);

$options = array(Page::imageLink('New Note', 'new/', 'create-note'));
if ($notes) {
    $options[] = Page::imageLink(
        'Delete All Notes',
        'delete-all/',
        'trash-bin'
    );
}

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Notes';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Notes',
        $pageMessages.$filterMessage.join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
