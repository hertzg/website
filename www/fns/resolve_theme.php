<?php

function resolve_theme ($user, &$theme_color, &$theme_brightness) {

    if ($user === null) {

        include_once __DIR__.'/Theme/Color/getDefault.php';
        $theme_color = Theme\Color\getDefault();

        include_once __DIR__.'/Theme/Brightness/getDefault.php';
        $theme_brightness = Theme\Brightness\getDefault();

    } else {
        $theme_color = $user->theme_color;
        $theme_brightness = $user->theme_brightness;
    }

    if ($theme_brightness === 'auto') {
        $time = time();
        if ($user !== null) $time += $user->timezone * 60;
        $hour = date('H', $time);
        if ($hour > 21 || $hour < 8) $theme_brightness = 'dark';
        else $theme_brightness = 'light';
    }

}
