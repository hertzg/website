<?php

function evaluate ($expression, &$error = null, &$error_char = 0) {

    $chars = str_split($expression);
    $num_chars = count($chars);
    if ($num_chars === 1 && $chars[0] === '') {
        $chars = [];
        $num_chars = 0;
    }

    $operations = [];
    $num_operations = 0;

    $values = [];
    $num_values = 0;

    $value_expected = true;
    $negative_expected = true;
    $operation_expected = false;
    $next_value_sign = 1;

    $pop_operation = function () use (&$operations, &$num_operations) {
        assert($num_operations > 0);
        $num_operations--;
        return array_pop($operations);
    };

    $pop_value = function () use (&$values, &$num_values) {
        assert($num_values > 0);
        $num_values--;
        return array_pop($values);
    };

    $push_operation = function ($operation) use (&$operations, &$num_operations) {
        $num_operations++;
        $operations[] = $operation;
    };

    $push_value = function ($value) use (&$values, &$num_values) {
        $num_values++;
        $values[] = $value;
    };

    $apply = function () use ($pop_operation, $pop_value, $push_value) {

        $operation = $pop_operation();
        $b = $pop_value();
        $a = $pop_value();

        if ($operation === '+') $value = $a + $b;
        elseif ($operation === '-') $value = $a - $b;
        elseif ($operation === '*') $value = $a * $b;
        elseif ($operation === '/') $value = $a / $b;
        else assert(false);

        $push_value($value);

    };

    $index = 0;
    while ($index < $num_chars) {
        $char = $chars[$index];
        if ($char === ' ') {
            $index++;
        } elseif ($char >= '0' && $char <= '9') {

            if (!$value_expected) {
                $error_char = $index;
                $error = 'Unexpected number.';
                return false;
            }

            $digits = '';
            while (true) {
                $digits .= $char;
                $index++;
                if ($index === $num_chars) break;
                $char = $chars[$index];
                if ($char < '0' || $char > '9') break;
            }
            $digits = intval($digits) * $next_value_sign;

            $push_value($digits);

            $value_expected = $negative_expected = false;
            $operation_expected = true;

        } elseif ($char === '+' || $char === '-') {
            if ($operation_expected) {

                while ($operations) {
                    $operation = $operations[$num_operations - 1];
                    if ($operation !== '+' && $operation !== '-' &&
                        $operation !== '*' && $operation !== '/') break;
                    $apply();
                }

                $push_operation($char);
                $index++;

                $value_expected = true;
                $negative_expected = false;
                $operation_expected = false;
                $next_value_sign = 1;

            } elseif ($char === '-' && $negative_expected) {
                $negative_expected = false;
                $next_value_sign = -1;
                $index++;
            } else {
                $error_char = $index;
                $error = "Unexpected operator \"$char\".";
                return false;
            }
        } elseif ($char === '*' || $char === '/') {

            if (!$operation_expected) {
                $error_char = $index;
                $error = "Unexpected operator \"$char\".";
                return false;
            }

            while ($operations) {
                $operation = $operations[$num_operations - 1];
                if ($operation !== '*' && $operation !== '/') break;
                $apply();
            }

            $push_operation($char);
            $index++;

            $value_expected = true;
            $negative_expected = true;
            $operation_expected = false;
            $next_value_sign = 1;

        } elseif ($char === '(') {

            $push_operation('(');
            $index++;

            $value_expected = true;
            $negative_expected = true;
            $operation_expected = false;
            $next_value_sign = 1;

        } elseif ($char === ')') {
            $found = false;
            while ($operations) {
                $operation = $operations[$num_operations - 1];
                if ($operation === '(') {
                    $pop_operation();
                    $value_expected = $negative_expected = false;
                    $operation_expected = true;
                    $found = true;
                    break;
                }
                $apply();
            }
            if (!$found) {
                $error_char = $index;
                $error = 'Unbalanced closing bracket.';
                return false;
            }
            $index++;
        } else {
            $error_char = $index;
            $error = "Unexpected character \"$char\".";
            return false;
        }
    }

    while ($operations) {
        $operation = $operations[$num_operations - 1];
        if ($operation === '(') {
            $error_char = $index;
            $error = 'Expected closing bracket.';
            return false;
        }
        $apply();
    }

    if ($num_values === 0) {
        $error_char = $index;
        $error = 'Expected expression.';
        return false;
    }

    return $pop_value();

}
