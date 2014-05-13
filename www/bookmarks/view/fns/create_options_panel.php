<?php

function create_options_panel ($bookmark) {

    include_once __DIR__.'/../../fns/create_open_links.php';
    $values = create_open_links($bookmark->url, '../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once __DIR__.'/../../../fns/ItemList/escapedItemQuery.php';
    $queryString = ItemList\escapedItemQuery($bookmark->id_bookmarks);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

    $href = "../edit/$queryString";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-bookmark');

    $href = "../send/$queryString";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Bookmark Options', $content);

}
