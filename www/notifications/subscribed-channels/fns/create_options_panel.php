<?php

function create_options_panel () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $subscribeLink = Page\imageArrowLink('Subscribe to a Public Channel',
        'subscribe/', 'create-subscribed-channel', ['id' => 'subscribe']);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $subscribeLink);

}
