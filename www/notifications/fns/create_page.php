<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    unset(
        $_SESSION['home/messages'],
        $_SESSION['notifications/channels/errors'],
        $_SESSION['notifications/channels/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/post/errors'],
        $_SESSION['notifications/post/messages'],
        $_SESSION['notifications/subscribed-channels/messages']
    );

    $fnsDir = __DIR__.'/../../fns';

    if ($user->num_new_notifications || $user->home_num_new_notifications) {
        include_once "$fnsDir/Users/Notifications/clearNumberNew.php";
        Users\Notifications\clearNumberNew($mysqli, $user);
    }

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    $options = [];

    if ($user->num_channels) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $options[] = Page\imageArrowLink('Post a Notification',
            "{$base}post/", 'create-notification');
    }

    include_once __DIR__.'/create_channels_link.php';
    $options[] = create_channels_link($user, $base);

    include_once __DIR__.'/create_subscribed_channels_link.php';
    $options[] = create_subscribed_channels_link($user, $base);

    $items = [];

    if ($user->num_notifications) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../");

        include_once "$fnsDir/Notifications/indexPageOnUser.php";
        $notifications = Notifications\indexPageOnUser($mysqli,
            $user->id_users, $offset, $limit, $total);

        include_once "$fnsDir/check_offset_overflow.php";
        check_offset_overflow($offset, $limit, $total);

        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        $escapedPageQuery = ItemList\escapedPageQuery();

        include_once "$fnsDir/Page/imageLink.php";
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] = Page\imageLink('Delete All Notifications',
            $href, 'trash-bin', ['id' => 'delete-all']);

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items);

        include_once __DIR__.'/render_notifications.php';
        render_notifications($user, $notifications, $offset, $base, $items);

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No notifications');
    }

    include_once __DIR__.'/create_content.php';
    return create_content($mysqli, $user, $items, $options, $base);

}
