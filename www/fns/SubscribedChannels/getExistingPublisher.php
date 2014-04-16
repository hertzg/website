<?php

namespace SubscribedChannels;

function getExistingPublisher ($mysqli, $id_channels, $publisher_id_users) {
    $sql = 'select * from subscribed_channels'
        ." where id_channels = $id_channels"
        ." and publisher_id_users = $publisher_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
