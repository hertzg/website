<?php

namespace HomePage;

function renderCalculations ($user) {

    $fnsDir = __DIR__.'/..';

    $num_calculations = $user->num_calculations;
    $num_new_received = $user->num_received_calculations -
        $user->num_archived_received_calculations;

    $title = 'Calculations';
    $href = '../calculations/';
    $icon = 'calculations';
    $options = ['id' => 'calculations'];

    if ($num_calculations || $num_new_received) {

        $descriptions = [];
        if ($num_calculations) {
            $descriptions[] = "$num_calculations&nbsp;total.";
        }
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
