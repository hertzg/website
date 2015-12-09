<?php

namespace Users\Calculations;

function edit ($mysqli, $calculation, $title,
    $expression, $tags, $tag_names, $value, $error, $error_char,
    $referenced_calculations, &$changed, $updateApiKey = null) {

    if ($calculation->title === $title &&
        $calculation->expression === $expression &&
        $calculation->tags === $tags) return;

    $changed = true;
    $id = $calculation->id;
    $fnsDir = __DIR__.'/../..';
    $update_time = time();

    include_once "$fnsDir/Calculations/edit.php";
    \Calculations\edit($mysqli, $id, $title, $expression, $tags,
        $tag_names, $value, $error, $error_char, $update_time, $updateApiKey);

    if ($calculation->num_tags) {
        include_once "$fnsDir/CalculationTags/deleteOnCalculation.php";
        \CalculationTags\deleteOnCalculation($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/CalculationTags/add.php";
        \CalculationTags\add($mysqli, $calculation->id_users,
            $id, $tag_names, $expression, $title, $value, $error,
            $error_char, $calculation->insert_time, $update_time);
    }

    include_once "$fnsDir/ReferencedCalculations/deleteOnCalculation.php";
    \ReferencedCalculations\deleteOnCalculation($mysqli, $id);

    if ($referenced_calculations) {
        include_once "$fnsDir/ReferencedCalculations/add.php";
        foreach ($referenced_calculations as $referenced_calculation) {
            \ReferencedCalculations\add($mysqli,
                $id, $referenced_calculation->id);
        }
    }

    include_once __DIR__.'/updateReferences.php';
    updateReferences($mysqli, $id);

}
