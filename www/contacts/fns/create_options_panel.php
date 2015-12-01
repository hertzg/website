<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

    $num_received = $user->num_received_contacts;
    if ($num_received) {

        $num_new = $num_received - $user->num_archived_received_contacts;
        if ($num_new > 0) {
            if ($num_new == $num_received) $description = "$num_new new.";
            else $description = "$num_new new. $num_received total.";
        } else $description = "$num_received total.";

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $options[] = Page\imageArrowLinkWithDescription('Received Contacts',
            $description, "{$base}received/", 'receive', ['id' => 'received']);

    }

    if ($user->num_contacts) {
        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        $href = "{$base}delete-all/".ItemList\escapedPageQuery();
        include_once "$fnsDir/Page/imageLink.php";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Contacts', $href, 'trash-bin')
            .'</div>';
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
