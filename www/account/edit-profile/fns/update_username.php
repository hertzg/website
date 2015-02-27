<?php

function update_username ($mysqli, $id_users, $username) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Channels/editUser.php";
    Channels\editUser($mysqli, $id_users, $username);

    include_once "$fnsDir/Connections/editConnectedUser.php";
    Connections\editConnectedUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedBookmarks/editSenderUser.php";
    ReceivedBookmarks\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedContacts/editSenderUser.php";
    ReceivedContacts\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedFiles/editSenderUser.php";
    ReceivedFiles\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedFolders/editSenderUser.php";
    ReceivedFolders\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedNotes/editSenderUser.php";
    ReceivedNotes\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedPlaces/editSenderUser.php";
    ReceivedPlaces\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/ReceivedTasks/editSenderUser.php";
    ReceivedTasks\editSenderUser($mysqli, $id_users, $username);

    include_once "$fnsDir/SubscribedChannels/editPublisherUser.php";
    SubscribedChannels\editPublisherUser($mysqli, $id_users, $username);

    include_once "$fnsDir/SubscribedChannels/editSubscriberUser.php";
    SubscribedChannels\editSubscriberUser($mysqli, $id_users, $username);

    include_once "$fnsDir/DeletedItems/editSenderUser.php";
    DeletedItems\editSenderUser($mysqli, $id_users, $username);

}
