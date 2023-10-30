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
        $s3 = App::make("aws")->createClient("s3");

        dd(env("AWS_BUCKET"), env("AWS_BUCKET2"), env("QWQWQW"));
        /** @var Result $result */
        $result = $s3->putObject([
            "Bucket" => env("AWS_BUCKET"),
            "Key" => env("AWS_ENV") . "/" . $directoryName . "/1",
        ]);

        return $result->get("ObjectURL");
    }

    public function uploadFile(string $directoryName, $file): array|null
    {
        /** @var S3Client $s3 */
        $s3 = App::make("aws")->createClient("s3");

        try {
            /** @var Result $result */
            $result = $s3->putObject([
                "Bucket" => env("AWS_BUCKET"),
                "Key" => env("AWS_ENV") . "/" . $directoryName,
                "SourceFile" => $file,
            ]);

            return [
                $directoryName,
                $result->get("ObjectURL")
            ];

        } catch (\Exception $exception) {

        }

        return null;
    }

    public function removeFileAndFolder(string $Key): string|null
    {
        /** @var S3Client $s3 */
        $s3 = App::make("aws")->createClient("s3");

        try {
            /** @var Result $result */
            $result = $s3->deleteObject([
                "Bucket" => env("AWS_BUCKET"),
                "Key" => env("AWS_ENV") . "/" . $Key,
            ]);

        } catch (\Exception $exception) {

        }

        return null;
    }


}
