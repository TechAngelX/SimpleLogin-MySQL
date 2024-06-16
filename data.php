<?php
header('Content-Type: application/json');

// Example data
$data = [
    [ "text" =>"This is new text, from data.php.",

        ],
    [
        "image" => "images/demonLogo150.png",
        "text" => "This is the first image."
    ],
    [
        "image" => "images/tick-success.png",
        "text" => "This is the second image."
    ],
    [
        "image" => "images/btcLogo.png",
        "text" => "This is the third image."
    ]
];

echo json_encode($data);
