<?php

function create_content ($user, $filterMessage, $items) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $newTaskHref = 'new/'.ItemList\escapedPageQuery();

    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once "$fnsDir/Page/activeButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/',
                ],
            ],
            'Tasks',
            Page\sessionErrors('tasks/errors')
            .Page\sessionMessages('tasks/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            Page\activeButton('New Task', $newTaskHref, 'create-task')
        )
        .create_options_panel($user);

}
