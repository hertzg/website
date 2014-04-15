<?php

namespace SubscribedChannels;

function deleteContainingUser ($mysqli, $id_users) {

    $sql = 'delete from subscribed_channels'
        ." where subscriber_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $sql = "select * from subscribed_channels where publisher_id_users = $id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    $subscribedChannels = mysqli_query_object($mysqli, $sql);

    include_once __DIR__.'/deleteArray.php';
    deleteArray($mysqli, $subscribedChannels);

}
