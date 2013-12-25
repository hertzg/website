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

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Notes.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($keyword, $tag) = request_strings('keyword', 'tag');

$items = array();
$filterMessage = '';

if ($keyword === '') {
    if ($tag === '') {

        $notes = Notes::index($idusers);

        if (count($notes) > 1) {

            include_once 'fns/create_search_form_empty_content.php';
            $items[] = create_search_form(create_search_form_empty_content('Search notes...'));

            include_once '../classes/NoteTags.php';
            $tags = NoteTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        $notes = Notes::indexOnTag($idusers, $tag);

        if (count($notes) > 1) {
            include_once 'fns/create_search_form_empty_content.php';
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

        $notes = Notes::search($idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search notes...')
            .'<a href="./" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; position: absolute">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto">'
                .'</div>'
            .'</a>'
        );
        if (count($notes) > 1) {
            include_once '../classes/NoteTags.php';
            $tags = NoteTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }
        }

    } else {

        $notes = Notes::searchOnTag($idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search notes...')
            .createTagInput($tag)
            .'<a href="?tag='.rawurlencode($tag).'" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto">'
                .'</div>'
            .'</a>'
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
        $items[] = Page::imageLink(htmlspecialchars($note->notetext), "view.php?id=$note->idnotes", 'note');
    }
} else {
    $items[] = Page::info('No notes.');
}

unset(
    $_SESSION['home_messages'],
    $_SESSION['notes/add_errors'],
    $_SESSION['notes/edit_errors'],
    $_SESSION['notes/view_messages']
);

$page->base = '../';
$page->title = 'Notes';
$page->finish(
    Tab::create(
        Tab::activeItem('Notes'),
        Page::messages(ifset($_SESSION['notes/index_messages']))
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink('New Note', 'add.php', 'create-note')
    )
);
