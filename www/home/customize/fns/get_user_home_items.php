<?php

function get_user_home_items (array $homeItems, $user) {
    $order_home_items = json_decode($user->order_home_items);
    $userHomeItems = [];
    foreach ($order_home_items as $key) {
        $userHomeItems[$key] = $homeItems[$key];
    }
    return $userHomeItems;
}
