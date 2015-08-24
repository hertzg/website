<?php

namespace Form;

function datefield ($day, $month, $year,
    $text, $required, $emptyOption = false) {

    if ($required) $requiredAttribute = ' required="required"';
    else $requiredAttribute = '';

    if ($emptyOption) $emptyOption = '<option value="">--</option>';
    else $emptyOption = '';

    if (array_key_exists('max', $year)) $maxYear = $year['max'];
    else $maxYear = date('Y');

    if (array_key_exists('min', $year)) $minYear = $year['min'];
    else $minYear = $maxYear - 100;

    $selectedDay = $day['value'];
    $selectedMonth = $month['value'];
    $selectedYear = $year['value'];

    $dayName = $day['name'];

    $daySelect =
        '<select class="form-select day"'
        ." name=\"$dayName\" id=\"$dayName\"$requiredAttribute>$emptyOption";
    for ($i = 1; $i <= 31; $i++) {
        if ($i == $selectedDay) $selectedAttribute = ' selected="selected"';
        else $selectedAttribute = '';
        $daySelect .= "<option value=\"$i\"$selectedAttribute>$i</option>";
    }
    $daySelect .= '</select>';

    $monthSelect =
        '<select class="form-select month"'
        ." name=\"$month[name]\"$requiredAttribute>$emptyOption";
    for ($i = 1; $i <= 12; $i++) {
        if ($i == $selectedMonth) $selectedAttribute = ' selected="selected"';
        else $selectedAttribute = '';
        $monthSelect .=
            "<option value=\"$i\"$selectedAttribute>"
                .date('F', mktime(0, 0, 0, $i, 1))
            .'</option>';
    }
    $monthSelect .= '</select>';

    $yearSelect =
        '<select class="form-select year"'
        ." name=\"$year[name]\"$requiredAttribute>$emptyOption";
    for ($i = $maxYear; $i >= $minYear; $i--) {
        if ($i == $selectedYear) $selectedAttribute = ' selected="selected"';
        else $selectedAttribute = '';
        $yearSelect .= "<option$selectedAttribute>$i</option>";
    }
    $yearSelect .= '</select>';

    $html =
        '<div class="datefield">'
            .$daySelect.$monthSelect.$yearSelect
        .'</div>';

    include_once __DIR__.'/association.php';
    return association($html, "<label for=\"$dayName\">$text:</label>");

}
