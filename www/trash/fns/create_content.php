<?php

function create_content ($items, $optionsPanel, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DeletedItems/expireDays.php";
    $expireDays = DeletedItems\expireDays();

    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../home/#trash",
            ],
            'Trash',
            Page\sessionErrors('trash/errors')
            .Page\sessionMessages('trash/messages')
            .join('<div class="hr"></div>', $items)
            .Page\infoText('Items in Trash are automatically'
                ." purged in $expireDays days after deletion.")
        )
        .$optionsPanel;

}
