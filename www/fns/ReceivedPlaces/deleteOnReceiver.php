<?php

namespace ReceivedPlaces;

function deleteOnReceiver ($mysqli, $receiver_id_users) {
    $sql = 'delete from received_places'
        ." where receiver_id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
