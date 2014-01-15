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
            $items[] = create_search_form(create_search_form_empty_content('Search contacts...'));

            include_once '../classes/ContactTags.php';
            $tags = ContactTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        $contacts = Contacts::indexOnTag($idusers, $tag);

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

        $contacts = Contacts::search($idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search contacts...')
            .'<a href="./" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; position: absolute">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto">'
                .'</div>'
            .'</a>'
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

        $contacts = Contacts::searchOnTag($idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search contacts...')
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

if ($contacts) {
    foreach ($contacts as $contact) {
        $items[] = Page::imageLink(
            htmlspecialchars($contact->fullname),
            "view.php?id=$contact->idcontacts",
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
    $_SESSION['contacts/add_errors'],
    $_SESSION['contacts/add_lastpost'],
    $_SESSION['contacts/view_messages'],
    $_SESSION['notifications_messages']
);

$options = array(Page::imageLink('New Contact', 'new/', 'create-contact'));
if ($contacts) {
    $options[] = Page::imageLink(
        'Delete All Contacts',
        'delete-all.php',
        'trash-bin'
    );
}

$page->base = '../';
$page->title = 'Contacts';
$page->finish(
    Tab::create(
        Tab::activeItem('Contacts'),
        $pageMessages
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
