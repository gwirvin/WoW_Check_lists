<?php

$order = array(1,5,2,4,3,6);

$array = array(
    1 => 'one',
    2 => 'two',
    3 => 'three',
    4 => 'four',
    5 => 'five',
    6 => 'six'
);

uksort($array, function($key1, $key2) use ($order) {
    return (array_search($key1, $order) > array_search($key2, $order));
});

print_r($array);
