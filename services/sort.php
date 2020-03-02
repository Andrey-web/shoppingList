<?php

usort($goods, 'my_sort_function');
usort($hGoods, 'my_sort_function');
usort($pharmacy, 'my_sort_function');

function my_sort_function($a, $b) {
    return $b->name < $a->name;
}