<?php

function create_sender_description ($receivedItem) {
    $username = htmlspecialchars($receivedItem->sender_username);
    include_once __DIR__.'/export_date_ago.php';
    return "From $username ".export_date_ago($receivedItem->insert_time).'.';
}
