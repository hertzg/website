<?php

function get_user_home_items ($homeItems, $user) {
    $order_home_items = json_decode($user->order_home_items);
    $userHomeItems = [];
    foreach ($order_home_items as $key) {
        if ($key === 'admin' && !$user->admin) continue;
        if (array_key_exists($key, $homeItems)) {
            $userHomeItems[$key] = $homeItems[$key];
        }
    }
    return $userHomeItems;
}
