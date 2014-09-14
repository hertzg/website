<?php

function render_bookmarks ($user, &$items) {

    if (!$user->show_bookmarks) return;

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $num_bookmarks = $user->num_bookmarks;
    $num_received_bookmarks = $user->num_received_bookmarks;

    $title = 'Bookmarks';
    $href = '../bookmarks/';
    $icon = 'bookmarks';
    if ($num_bookmarks || $num_received_bookmarks) {

        $descriptionItems = [];
        if ($num_bookmarks) $descriptionItems[] = "$num_bookmarks total.";
        if ($num_received_bookmarks) {
            $descriptionItems[] = "$num_received_bookmarks received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        $link = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once "$fnsPageDir/imageArrowLink.php";
        $link = Page\imageArrowLink($title, $href, $icon);
    }

    $items['bookmarks'] = $link;

}
