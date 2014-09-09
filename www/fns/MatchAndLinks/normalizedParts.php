<?php

namespace MatchAndLinks;

function normalizedParts ($parts) {
    $normalizedParts = [];
    $linkStarted = false;
    $keywordStarted = false;
    foreach ($parts as $part) {
        $type = $part['type'];
        $index = $part['index'];
        if ($type == 'linkStart') {
            if ($keywordStarted) {
                if ($keywordStartIndex == $index) {
                    array_pop($normalizedParts);
                } else {
                    $normalizedParts[] = [
                        'type' => 'keywordEnd',
                        'index' => $index,
                    ];
                }
            }
            $linkStarted = true;
            $normalizedParts[] = $part;
            if ($keywordStarted) {
                $keywordStartIndex = $index;
                $normalizedParts[] = [
                    'type' => 'keywordStart',
                    'index' => $index,
                ];
            }
        } elseif ($type == 'linkEnd') {
            if ($keywordStarted) {
                $normalizedParts[] = [
                    'type' => 'keywordEnd',
                    'index' => $index,
                ];
            }
            $linkStarted = false;
            $normalizedParts[] = $part;
            if ($keywordStarted) {
                $normalizedParts[] = [
                    'type' => 'keywordStart',
                    'index' => $index,
                ];
            }
        } elseif ($type == 'keywordStart') {
            $keywordStarted = true;
            $normalizedParts[] = $part;
            $keywordStartIndex = $index;
        } elseif ($type == 'keywordEnd') {
            $keywordStarted = false;
            $normalizedParts[] = $part;
        }
    }
    return $normalizedParts;
}
