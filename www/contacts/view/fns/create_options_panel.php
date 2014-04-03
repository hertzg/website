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

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns(
            $favoriteLink,
            Page\imageArrowLink('Edit', "../edit/?id=$id", 'edit-contact')
        )
        .'<div class="hr"></div>'
        .Page\twoColumns(
            Page\imageArrowLink('Send', "../send/?id=$id", 'send'),
            Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        );

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Contact Options', $content);
}
