<?php 
    require 'vendor/autoload.php';
    $client = new GuzzleHttp\Client();
    $res = $client->post('https://api.remove.bg/v1.0/removebg', [
        'multipart' => [
            [
                'name'     => 'image_file',
                'contents' => fopen('../images/manda2.jpeg', 'r')
            ],
            [
                'name'     => 'size',
                'contents' => 'auto'
            ]
        ],
        'headers' => [
            'X-Api-Key' => 'jJLwUeEEtEQmSmRLjp2FE82t'
        ]
    ]);

    $fp = fopen("no-bg.png", "wb");
    fwrite($fp, $res->getBody());
    fclose($fp);
 ?>