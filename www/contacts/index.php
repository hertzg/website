<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Contacts.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';
include_once '../classes/Users.php';

list($keyword) = request_strings('keyword');

$items = array();

if ($keyword === '') {
    $contacts = Contacts::index($idusers);
    if (count($contacts) > 1) {
        $items = array(
            create_search_form(
                '<div style="position: absolute; top: 0; right: 48px; bottom: 0; left: 0">'
                    .'<input class="form-textfield" type="text" name="keyword"'
                    .' value="'.htmlspecialchars($keyword).'"'
                    .' placeholder="Search contacts..."'
                    .' style="width: 100%; height: 100%; cursor: text" />'
                .'</div>'
                .'<button class="clickable" style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center">'
                    .'<span class="icon search"></span>'
                .'</button>'
            ),
        );
    }
} else {
    $contacts = Contacts::search($idusers, $keyword);
    $items = array(
        create_search_form(
            '<div style="position: absolute; top: 0; right: 96px; bottom: 0; left: 0">'
                .'<input class="form-textfield" type="text" name="keyword"'
                .' value="'.htmlspecialchars($keyword).'"'
                .' placeholder="Search contacts..."'
                .' style="width: 100%; height: 100%; cursor: text" />'
            .'</div>'
            .'<button class="clickable" title="Search"'
            .' style="position: absolute; top: 0; right: 48px; bottom: 0; width: 48px; text-align: center">'
                .'<span class="icon search"></span>'
            .'</button>'
            .'<a href="./" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto">'
                .'</div>'
            .'</a>'
        ),
    );
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

unset(
    $_SESSION['contacts/add_errors'],
    $_SESSION['contacts/add_lastpost'],
    $_SESSION['contacts/view_messages'],
    $_SESSION['notifications_messages']
);

$page->base = '../';
$page->title = 'Contacts';
$page->finish(
    Tab::create(
        Tab::activeItem('Contacts'),
        Page::messages(ifset($_SESSION['contacts/index_messages']))
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink('New Contact', 'add.php', 'create-contact')
    )
);
