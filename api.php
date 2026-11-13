<?php
header("Content-Type: application/json; charset=UTF-8");

// Example: Fetching live data from a public API
$apiUrl = "https://api.coindesk.com/v1/bpi/currentprice.btc.json";
$liveData = @file_get_contents($apiUrl);

if ($liveData === FALSE) {
    echo json_encode(["status" => "error", "message" => "Could not fetch external live data"]);
} else {
    // Pass the live data straight through to your frontend JavaScript
    echo $liveData;
}