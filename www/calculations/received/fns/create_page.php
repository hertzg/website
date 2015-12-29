<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($all) = request_strings('all');

    if ($all) {
        include_once "$fnsDir/ReceivedCalculations/indexOnReceiver.php";
        $receivedCalculations = ReceivedCalculations\indexOnReceiver(
            $mysqli, $id_users);
    } else {
        include_once "$fnsDir/ReceivedCalculations/indexNotArchivedOnReceiver.php";
        $receivedCalculations = ReceivedCalculations\indexNotArchivedOnReceiver(
            $mysqli, $id_users);
    }

    $items = [];

    if ($receivedCalculations) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/create_sender_description.php";
        include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($receivedCalculations as $receivedCalculation) {

            $id = $receivedCalculation->id;
            $options = ['id' => $id];

            $title = $receivedCalculation->title;
            if ($title === '') $title = $receivedCalculation->expression;
            $title = htmlspecialchars($title);

            $description = create_sender_description($receivedCalculation);
            $href = "{$base}view/".ItemList\Received\escapedItemQuery($id);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'calculation', $options);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received calculations');
    }

    if (!$all && $user->num_archived_received_calculations) {
        include_once "$fnsDir/Page/buttonLink.php";
        $items[] = Page\buttonLink('Show Archived Calculations', '?all=1');
    }

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/".ItemList\Received\escapedPageQuery();
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Calculations', $href, 'trash-bin')
        .'</div>';

    include_once __DIR__.'/create_tabs.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\create(
        [
            'title' => 'Home',
            'href' => "$base../../home/#calculations",
        ],
        'Calculations',
        create_tabs($user)
        .Page\sessionErrors('calculations/received/errors')
        .Page\sessionMessages('calculations/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink),
        create_new_item_button('Calculation', "{$base}../")
    );

}
