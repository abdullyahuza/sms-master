<?php
require '../../vendor/autoload.php';
$folder = "/sms-master/admin/picture/uploads/";
$destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder; // you may need to adjust to your server configuration
$maxFileSize = 2 * 1024 * 1024;

// Get the posted data
$postdata = file_get_contents("php://input");

if (!isset($postdata) || empty($postdata))
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));

// Extract the data
$request = json_decode($postdata);

// Validate
if (trim($request->data) === "")
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));


$file = $request->data;
$name = $request->name;

// getimagesize is used to get the file extension
// Only png / jpg mime types are allowed
$size = getimagesize($file);
$ext = $size['mime'];
if ($ext == 'image/jpeg')
    $ext = '.JPG';
elseif ($ext == 'image/png')
    $ext = '.PNG';
else
    exit(json_encode(['success' => false, 'reason' => 'only png and jpg mime types are allowed']));

// Prevent the upload of large files
if (strlen(base64_decode($file)) > $maxFileSize)
    exit(json_encode(['success' => false, 'reason' => "file size exceeds {$maxFileSize} Mb"]));

// Remove inline tags and spaces
$img = str_replace('data:image/png;base64,', '', $file);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);

// Read base64 encoded string as an image
$img = base64_decode($img);

// Give the image a unique name. Don't forget the extension
// $filename = date("d_m_Y_H_i_s") . "-" . time() . $ext;
$filename = $name . $ext;

// The path to the newly created file inside the upload folder
$destinationPath = "$destinationFolder$filename";

//send the image to remove bg

// Create the file or return false
$success = file_put_contents($destinationPath, $img);

if (!$success)
    exit(json_encode(['success' => false, 'reason' => 'the server failed in creating the image']));

sleep(2);

$client = new GuzzleHttp\Client();
$res = $client->post('https://api.remove.bg/v1.0/removebg', [
    'multipart' => [
        [
            'name'     => 'image_file',
            'contents' => fopen('../uploads/'.$filename, 'r')
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

$fp = fopen($filename, "wb");
fwrite($fp, $res->getBody());
fclose($fp);

// Inform the browser about the path to the newly created image
exit(json_encode(['success' => true, 'path' => "$folder$filename"]));

?>