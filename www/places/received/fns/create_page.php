<?php

function create_page ($mysqli, $user, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedPlaces/indexOnReceiver.php";
        $receivedPlaces = ReceivedPlaces\indexOnReceiver($mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedPlaces/indexNotArchivedOnReceiver.php";
        $receivedPlaces = ReceivedPlaces\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    $items = [];

    if ($receivedPlaces) {
        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedPlaces as $receivedPlace) {

            $id = $receivedPlace->id;
            $options = ['id' => $id];

            $name = $receivedPlace->name;
            if ($name === '') {
                $title = "$receivedPlace->latitude $receivedPlace->longitude";
            } else {
                $title = htmlspecialchars($name);
            }

            $description = create_sender_description($receivedPlace);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'place', $options);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received places');
    }

    if (!$all && $user->num_archived_received_places) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Places', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Places', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Places',
                'href' => "$base../#received",
            ],
        ],
        'Received',
        Page\sessionMessages('places/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Place', "$base../")
    );

}
