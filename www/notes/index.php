<?php

function create_search_form ($content) {
    return
        '<form action="search/" style="height: 48px; position: relative">'
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
list($tag) = request_strings('tag');

$items = array();
$filterMessage = '';

if ($tag === '') {

    include_once '../fns/Notes/indexOnUser.php';
    $notes = Notes\indexOnUser($mysqli, $idusers);

    if (count($notes) > 1) {

        include_once '../fns/create_search_form_empty_content.php';
        $items[] = create_search_form(
            create_search_form_empty_content('Search notes...')
        );

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

include_once 'fns/render_notes.php';
render_notes($notes, $items);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('notes/index_messages');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['notes/new/index_errors'],
    $_SESSION['notes/new/index_lastpost'],
    $_SESSION['notes/view/index_messages']
);

$options = array(Page::imageArrowLink('New Note', 'new/', 'create-note'));
if ($notes) {
    $href = 'delete-all/';
    $options[] = Page::imageArrowLink('Delete All Notes', $href, 'trash-bin');
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
