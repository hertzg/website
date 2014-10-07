<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedBookmarks/indexOnReceiver.php";
        $receivedBookmarks = ReceivedBookmarks\indexOnReceiver(
            $mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedBookmarks/indexNotArchivedOnReceiver.php";
        $receivedBookmarks = ReceivedBookmarks\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    $items = [];

    if ($receivedBookmarks) {
        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedBookmarks as $receivedBookmark) {

            $title = $receivedBookmark->title;
            if ($title === '') $title = $receivedBookmark->url;
            $title = htmlspecialchars($title);

            $description = create_sender_description($receivedBookmark);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery(
                $receivedBookmark->id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'bookmark');

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received bookmarks');
    }

    if (!$all && $user->num_archived_received_bookmarks) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Bookmarks', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Bookmarks', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Bookmarks',
                'href' => "$base../".ItemList\Received\listHref(),
            ],
        ],
        'Received',
        Page\sessionMessages('bookmarks/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Bookmark', "{$base}../")
    );

}
