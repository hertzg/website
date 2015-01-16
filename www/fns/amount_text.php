<?php

function amount_text ($amount, $thousand = ',') {
    return number_format($amount / 100, 2, '.', $thousand);
}
