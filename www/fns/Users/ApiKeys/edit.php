<?php

namespace Users\ApiKeys;

function edit ($mysqli, $apiKey, $name, $expire_time, $can_read_bookmarks,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_places,
    $can_read_schedules, $can_read_tasks, $can_read_wallets,
    $can_write_bookmarks, $can_write_channels, $can_write_contacts,
    $can_write_events, $can_write_files, $can_write_notes,
    $can_write_notifications, $can_write_places, $can_write_schedules,
    $can_write_tasks, $can_write_wallets) {

    $id = $apiKey->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ApiKeys/edit.php";
    \ApiKeys\edit($mysqli, $id, $name, $expire_time, $can_read_bookmarks,
        $can_read_channels, $can_read_contacts, $can_read_events,
        $can_read_files, $can_read_notes, $can_read_notifications,
        $can_read_places, $can_read_schedules, $can_read_tasks,
        $can_read_wallets, $can_write_bookmarks, $can_write_channels,
        $can_write_contacts, $can_write_events, $can_write_files,
        $can_write_notes, $can_write_notifications, $can_write_places,
        $can_write_schedules, $can_write_tasks, $can_write_wallets);

    if ($name === $apiKey->name) return;

    include_once "$fnsDir/Bookmarks/editApiKey.php";
    \Bookmarks\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Channels/editApiKey.php";
    \Channels\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Contacts/editApiKey.php";
    \Contacts\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/DeletedItems/editApiKey.php";
    \DeletedItems\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Events/editApiKey.php";
    \Events\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Files/editApiKey.php";
    \Files\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Folders/editApiKey.php";
    \Folders\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Notes/editApiKey.php";
    \Notes\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Notifications/editApiKey.php";
    \Notifications\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Places/editApiKey.php";
    \Places\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/PlacePoints/editApiKey.php";
    \PlacePoints\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Schedules/editApiKey.php";
    \Schedules\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/SubscribedChannels/editApiKey.php";
    \SubscribedChannels\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Tasks/editApiKey.php";
    \Tasks\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/Wallets/editApiKey.php";
    \Wallets\editApiKey($mysqli, $id, $name);

    include_once "$fnsDir/WalletTransactions/editApiKey.php";
    \WalletTransactions\editApiKey($mysqli, $id, $name);

}
