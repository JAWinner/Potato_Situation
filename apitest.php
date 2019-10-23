<?php

require __DIR__ . '/vendor/autoload.php';

use AlphaVantage\Client;

$alpha_vantage = new Client('9J4N8FA67HVHYZG0');
$data = $alpha_vantage
    ->stock()
    ->intraday('GOOGL', AlphaVantage\Resources\Stock::INTERVAL_1MIN);

var_dump($data);

?>
