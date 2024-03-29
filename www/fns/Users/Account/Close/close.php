<?php

namespace Users\Account\Close;

function close ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ApiKeyAuths/deleteOnUser.php";
    \ApiKeyAuths\deleteOnUser($mysqli, $id_users);

    if ($user->num_api_keys) {
        include_once "$fnsDir/ApiKeys/deleteOnUser.php";
        \ApiKeys\deleteOnUser($mysqli, $id_users);
    }

    include_once __DIR__.'/deleteBarCharts.php';
    deleteBarCharts($mysqli, $user);

    include_once __DIR__.'/deleteBookmarks.php';
    deleteBookmarks($mysqli, $user);

    include_once __DIR__.'/deleteCalculations.php';
    deleteCalculations($mysqli, $user);

    if ($user->num_channels) {
        include_once "$fnsDir/Channels/deleteOnUser.php";
        \Channels\deleteOnUser($mysqli, $id_users);
    }

    include_once __DIR__.'/deleteConnections.php';
    deleteConnections($mysqli, $user);

    include_once __DIR__.'/deleteContacts.php';
    deleteContacts($mysqli, $user);

    include_once __DIR__.'/deleteDeletedItems.php';
    deleteDeletedItems($mysqli, $user);

    if ($user->num_events) {
        include_once "$fnsDir/Events/deleteOnUser.php";
        \Events\deleteOnUser($mysqli, $id_users);
    }

    include_once "$fnsDir/Feedbacks/deleteOnUser.php";
    \Feedbacks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/deleteFiles.php';
    deleteFiles($mysqli, $user);

    include_once __DIR__.'/deleteFolders.php';
    deleteFolders($mysqli, $user);

    include_once __DIR__.'/deleteNotes.php';
    deleteNotes($mysqli, $user);

    if ($user->num_notifications) {
        include_once "$fnsDir/Notifications/deleteOnUser.php";
        \Notifications\deleteOnUser($mysqli, $id_users);
    }

    include_once __DIR__.'/deletePlaces.php';
    deletePlaces($mysqli, $user);

    include_once __DIR__.'/deleteSchedules.php';
    deleteSchedules($mysqli, $user);

    if ($user->num_subscribed_channels) {
        include_once "$fnsDir/SubscribedChannels/deleteContainingUser.php";
        \SubscribedChannels\deleteContainingUser($mysqli, $id_users);
    }

    include_once __DIR__.'/deleteTasks.php';
    deleteTasks($mysqli, $user);

    include_once "$fnsDir/Signins/deleteOnUser.php";
    \Signins\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/deleteTokens.php';
    deleteTokens($mysqli, $user);

    include_once __DIR__.'/deleteWallets.php';
    deleteWallets($mysqli, $user);

    include_once __DIR__.'/../../delete.php';
    \Users\delete($mysqli, $id_users);

    include_once __DIR__.'/../../Directory/rmdirs.php';
    \Users\Directory\rmdirs($id_users);

}
