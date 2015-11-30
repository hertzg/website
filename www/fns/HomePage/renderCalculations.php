<?php

namespace HomePage;

function renderCalculations ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_calculation) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-calculation'] = \Page\thumbnailLink(
            'New Calculation', '../calculations/new/', 'create-calculation');
    }

    if (!$user->show_calculations) return;

    $num_calculations = $user->num_calculations;
    $num_received_calculations = $user->num_received_calculations;

    $title = 'Calculations';
    $href = '../calculations/';
    $icon = 'calculations';
    $options = ['id' => 'calculations'];
    if ($num_calculations || $num_received_calculations) {

        $descriptions = [];
        if ($num_calculations) $descriptions[] = "$num_calculations total.";
        if ($num_received_calculations) {
            $descriptions[] = "$num_received_calculations received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['calculations'] = $link;

}
