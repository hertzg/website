<?php

function create_received_from_item ($receivedItem) {

    $username = htmlspecialchars($receivedItem->sender_username);
    $sender_address = $receivedItem->sender_address;
    if ($sender_address !== null) {
        $username .= '@'.htmlspecialchars($sender_address);
    }

    include_once __DIR__.'/Form/label.php';
    return Form\label('Received from', $username);

}
