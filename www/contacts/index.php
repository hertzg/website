<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

function createTagInput ($tag) {
    return '<input type="hidden" name="tag"'
        .' value="'.htmlspecialchars($tag).'" />';
}

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/request_strings.php';
include_once '../classes/Contacts.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($keyword, $tag) = request_strings('keyword', 'tag');

$items = array();
$filterMessage = '';

if ($keyword === '') {
    if ($tag === '') {

        $contacts = Contacts::index($idusers);

        if (count($contacts) > 1) {

            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(
                create_search_form_empty_content('Search contacts...')
            );

            include_once '../classes/ContactTags.php';
            $tags = ContactTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        include_once '../classes/ContactTags.php';
        $contacts = ContactTags::indexOnTagName($idusers, $tag);

        if (count($contacts) > 1) {
            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(
                create_search_form_empty_content('Search contacts...')
                .createTagInput($tag)
            );
        }

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
} else {
    include_once '../fns/create_search_form_content.php';
    if ($tag === '') {

        include_once '../fns/Contacts/search.php';
        $contacts = Contacts\search($mysqli, $idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search contacts...', './')
        );
        if (count($contacts) > 1) {
            include_once '../classes/ContactTags.php';
            $tags = ContactTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }
        }

    } else {

        include_once '../fns/ContactTags/searchOnTagName.php';
        $contacts = ContactTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content(
                $keyword,
                'Search contacts...',
                '?tag='.rawurlencode($tag)
            )
            .createTagInput($tag)
        );

        $clearHref = '?'.htmlspecialchars(
            http_build_query(array('keyword' => $keyword))
        );
        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

    }
}

if ($contacts) {
    foreach ($contacts as $contact) {
        $items[] = Page::imageLink(
            htmlspecialchars($contact->fullname),
            "view/?id=$contact->idcontacts",
            'contact'
        );
    }
} else {
    $items[] = Page::info('No contacts.');
}

if (array_key_exists('contacts/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['contacts/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['contacts/new/index_errors'],
    $_SESSION['contacts/new/index_lastpost'],
    $_SESSION['contacts/view/index_messages'],
    $_SESSION['home/index_messages']
);

$options = array(Page::imageLink('New Contact', 'new/', 'create-contact'));
if ($contacts) {
    $options[] = Page::imageLink(
        'Delete All Contacts',
        'delete-all/',
        'trash-bin'
    );
}

$page->base = '../';
$page->title = 'Contacts';
$page->finish(
    Tab::create(
        Tab::item('Home', '..')
        .Tab::activeItem('Contacts'),
        $pageMessages
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
