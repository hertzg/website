<?php

namespace ViewPage;

function optionsPanel ($connection) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($connection->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-connection', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($editLink, $deleteLink);

    if ($connection->their_exchange_api_key !== null) {
        $content =
            \Page\imageLink('Test',
                "../submit-test.php$escapedItemQuery", 'yes')
            .'<div class="hr"></div>'
            .$content;
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Connection Options', $content);

}
