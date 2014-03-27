<?php

function create_options_panel ($channel_user) {

    $id = $channel_user->id;

    include_once __DIR__.'/../../../../fns/Page/imageLink.php';
    $link = Page\imageLink('Receive Notifications', "submit-receive.php?id=$id", 'TODO');

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Options', $link);

}
