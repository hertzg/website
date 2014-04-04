<?php

function create_options_panel ($contact) {

    $id = $contact->id_contacts;

    include_once __DIR__.'/../../../fns/Page/imageLink.php';
    if ($contact->favorite) {
        $href = "submit-set-regular.php?id=$id";
        $favoriteLink = Page\imageLink('Mark as Regular', $href, 'contact');
    } else {
        $title = 'Mark as Favorite';
        $href = "submit-set-favorite.php?id=$id";
        $favoriteLink = Page\imageLink($title, $href, 'favorite-contact');
    }

    include_once __DIR__.'/../../../fns/ItemList/escapedItemQuery.php';
    $queryString = ItemList\escapedItemQuery($id);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

    $href = "../edit/$queryString";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-contact');

    $sendLink = Page\imageArrowLink('Send', "../send/$queryString", 'send');

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($favoriteLink, $editLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($sendLink, $deleteLink);

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Contact Options', $content);
}
