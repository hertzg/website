<?php

function render_invitations ($invitations, &$items, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($invitations as $invitation) {

        $id = $invitation->id;
        $key = $invitation->key;
        $note = $invitation->note;

        $href = "{$base}view/?id=$id";
        $icon = 'invitation';
        $options = ['id' => $id];
        if ($note === '') {
            $link = Page\imageArrowLink($key, $href, $icon, $options);
        } else {
            $link = Page\imageArrowLinkWithDescription(
                htmlspecialchars($note), $key, $href, $icon, $options);
        }

        $items[] = $link;

    }

}
