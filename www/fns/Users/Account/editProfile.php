<?php

namespace Users\Account;

function editProfile ($mysqli, $user, $username, $email,
    $full_name, $timezone, $admin, $disabled, $expires, &$changed) {

    if ($user->username === $username && $user->email === $email &&
        $user->full_name === $full_name && $user->timezone === $timezone &&
        (bool)$user->admin === $admin &&
        (bool)$user->disabled === $disabled &&
        (bool)$user->expires === $expires) return;

    $changed = true;
    $id_users = $user->id_users;

    include_once __DIR__.'/../editProfile.php';
    \Users\editProfile($mysqli, $id_users, $username, $email,
        $full_name, $timezone, $admin, $disabled, $expires);

    if ($username !== $user->username) {

        $fnsDir = __DIR__.'/../../../fns';

        include_once "$fnsDir/Channels/editUser.php";
        \Channels\editUser($mysqli, $id_users, $username);

        include_once "$fnsDir/Connections/editConnectedUser.php";
        \Connections\editConnectedUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedBookmarks/editSenderUser.php";
        \ReceivedBookmarks\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedCalculations/editSenderUser.php";
        \ReceivedCalculations\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedContacts/editSenderUser.php";
        \ReceivedContacts\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedFiles/editSenderUser.php";
        \ReceivedFiles\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedFolders/editSenderUser.php";
        \ReceivedFolders\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedNotes/editSenderUser.php";
        \ReceivedNotes\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedPlaces/editSenderUser.php";
        \ReceivedPlaces\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedSchedules/editSenderUser.php";
        \ReceivedSchedules\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/ReceivedTasks/editSenderUser.php";
        \ReceivedTasks\editSenderUser($mysqli, $id_users, $username);

        include_once "$fnsDir/SubscribedChannels/editPublisherUser.php";
        \SubscribedChannels\editPublisherUser($mysqli, $id_users, $username);

        include_once "$fnsDir/SubscribedChannels/editSubscriberUser.php";
        \SubscribedChannels\editSubscriberUser($mysqli, $id_users, $username);

        include_once "$fnsDir/DeletedItems/editSenderUser.php";
        \DeletedItems\editSenderUser($mysqli, $id_users, $username);

    }

    if ($email !== $user->email) {
        include_once __DIR__.'/../Email/invalidate.php';
        \Users\Email\invalidate($mysqli, $id_users);
    }

}
