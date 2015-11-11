<?php

namespace ViewPage;

function optionsPanel ($id) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-api-key', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Admin API Key Options', $content);

}
