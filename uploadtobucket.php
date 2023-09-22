<?php
require('vendor/autoload.php');
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

function upload_to_bucket($file_Path){

$options = [
    'region' => 'us-east-1',
    'version' => '2006-03-01',
    'credentials' => [
          'key' => 'AKIARTIXH3A66INBL7WW',
          'secret' => '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'
    ]
];
$s3Client = new S3Client($options);

$bucketName = 'uppanammun';
//$file_Path = 'img/escudoinver.png';
$key = basename($file_Path);

// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
    $result = $s3Client->putObject([
    'Bucket' => $bucketName,
    'Key'    => $key,
    'Body'   => fopen($file_Path, 'r'),
    'ACL'    => 'public-read',
    ]);
    return "Image/File uploaded successfully. Image/File path is: ". $result->get('ObjectURL');
} catch (AwsS3ExceptionS3Exception $e) {
    //echo "There was an error uploading the file.n";
    return $e->getMessage();
}


}
