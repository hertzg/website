<?php

function steps ($doneSteps, $activeStep, $nextSteps) {
    $html = '<ul class="steps">';
    foreach ($doneSteps as $step) {
        $html .=
            '<li class="steps-done">'
                .'<code>&#x2713;</code> '
                ."<a class=\"link\" href=\"$step[href]\">"
                    .$step['title']
                .'</a>'
            .'</li>';
    }
    $html .=
        '<li class="steps-active">'
            ."<code>&bull;</code> $activeStep"
        .'</li>';
    foreach ($nextSteps as $step) {
        $html .=
            '<li class="steps-next">'
                ."<code>&bull;</code> $step"
            .'</li>';
    }
    $html .= '</ul>';
    return $html;
}
