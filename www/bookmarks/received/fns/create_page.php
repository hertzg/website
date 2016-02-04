<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

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

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedBookmarks as $receivedBookmark) {

            $id = $receivedBookmark->id;
            $options = ['id' => $id];

            $title = $receivedBookmark->title;
            if ($title === '') $title = $receivedBookmark->url;
            $title = htmlspecialchars($title);

            $description = create_sender_description($receivedBookmark);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'bookmark', $options);

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

    include_once __DIR__.'/create_tabs.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../../home/#bookmarks",
                'localNavigation' => true,
            ],
            'Bookmarks',
            create_tabs($user)
            .Page\sessionErrors('bookmarks/received/errors')
            .Page\sessionMessages('bookmarks/received/messages')
            .join('<div class="hr"></div>', $items),
            create_new_item_button('Bookmark', "{$base}../")
        )
        .create_panel('Options', $deleteAllLink);

}
