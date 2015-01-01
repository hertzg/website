<?php

function create_options_panel () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $subscribeLink = Page\imageArrowLink('Subscribe to a Public Channel',
        'subscribe/', 'create-subscribed-channel', ['id' => 'subscribe']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $subscribeLink);

}
