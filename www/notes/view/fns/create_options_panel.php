<?php

function create_options_panel ($id) {

    include_once __DIR__.'/../../../fns/ItemList/itemQueryHref.php';
    $queryString = ItemList\itemQueryHref($id);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns(
            Page\imageArrowLink('Edit', "../edit/?$queryString", 'edit-note'),
            Page\imageArrowLink('Send', "../send/?$queryString", 'send')
        )
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete', "../delete/?$queryString", 'trash-bin');

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Note Options', $content);

}
