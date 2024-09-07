<?php

function filterUniqueByTwoKeys(array $objects, $key1, $key2, $key3) {
    $seen = [];  // To track seen combinations
    $unique = [];  // To store unique objects

    foreach ($objects as $object) {
        if (isset($object[$key1]) && isset($object[$key2]) && isset($object[$key1])) {
            $combination = $object[$key1] . '|' . $object[$key2] . '|' . $object[$key3];  // Create a unique combination key
            
            // Check if the combination is already in the seen list
            if (!in_array($combination, $seen)) {
                $seen[] = $combination;  // Add combination to seen list
                $unique[] = $object;  // Add object to unique list
            }
        }
    }

    return $unique;
}