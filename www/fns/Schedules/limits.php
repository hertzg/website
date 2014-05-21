<?php

namespace Schedules;

function limits () {
    return [
        'minInterval' => 2,
        'maxInterval' => 30 * 12 + 1,
    ];
}
