<?php

function create_options_panel () {

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';
    $title = 'Subscribe to a Public Channel';
    $icon = 'create-subscribed-channel';
    $subscribeLink = Page\imageArrowLink($title, 'subscribe/', $icon);

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Options', $subscribeLink);

}
