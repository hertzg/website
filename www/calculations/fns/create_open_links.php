<?php

function create_open_links ($url, $base) {

    if (parse_url($url, PHP_URL_SCHEME) === null) $url = "http://$url";

    include_once __DIR__.'/../../fns/create_external_url.php';
    $url = create_external_url($url, $base);

    include_once __DIR__.'/../../fns/Page/imageLink.php';

    $openLink = Page\imageLink('Open', $url, 'run');

    $title = 'Open in New Tab';
    $openInNewTabLink = Page\imageLink($title, $url, 'run', [
        'target' => '_blank',
    ]);

    return [$openLink, $openInNewTabLink];

}
