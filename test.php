<?php
require 'vendor/autoload.php';

use Rubix\ML\Dataset;

$data = [
    'inputs' => [[1, 2], [3, 4], [5, 6]],
    'labels' => [0, 1, 1],
];

$dataset = Dataset::fromArray($data['inputs'], $data['labels']);

var_dump($dataset);
