<?php

function create_options_panel ($bookmark) {

    $id = $bookmark->id_bookmarks;

    $url = $bookmark->url;
    if (parse_url($url, PHP_URL_SCHEME) === null) {
        $parsedUrl = "http://$url";
    } else {
        $parsedUrl = $url;
    }
    include_once __DIR__.'/../../../fns/create_external_url.php';
    $externalUrl = create_external_url($parsedUrl, '../../');

    include_once __DIR__.'/../../../fns/Page/imageLink.php';

    $openLink = Page\imageLink('Open', $externalUrl, 'run');

    $title = 'Open in New Tab';
    $openInNewTabLink = Page\imageLink($title, $externalUrl, 'run', [
        'target' => '_blank',
    ]);

    include_once __DIR__.'/../../../fns/ItemList/itemQueryHref.php';
    $queryString = ItemList\itemQueryHref($bookmark->id_bookmarks);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

    $href = "../edit/?$queryString";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-bookmark');

    $href = "../send/?$queryString";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/?$queryString";
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
