<?php

namespace App\Services;

use Aws\Result;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\App;

class AwsService
{
    public function createDirectory(string $directoryName): string|null
    {
        /** @var S3Client $s3 */
        $s3 = App::make('aws')->createClient('s3');

        /** @var Result $result */
        $result = $s3->putObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => env("AWS_ENV") . "/" . $directoryName . "/1",
        ]);

        return $result->get("ObjectURL");
    }

}
