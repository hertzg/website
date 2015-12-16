<?php

function render_wallet ($wallet, &$title, &$icon) {
    $title = htmlspecialchars($wallet->name);
    $icon = 'wallet';
}
