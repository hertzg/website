<?php

namespace ViewPage;

function optionsPanel ($id) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns(
            \Page\imageArrowLink('Reset Password',
                "../reset-password/$escapedItemQuery",
                'reset-password', ['id' => 'reset-password']),
            \Page\imageArrowLink('Edit Profile',
                "../edit-profile/$escapedItemQuery",
                'edit-profile', ['id' => 'edit-profile'])
        )
        .'<div class="hr"></div>'
        .\Page\imageLink('Delete', "../delete/$escapedItemQuery",
            'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('User Options', $content);

}
