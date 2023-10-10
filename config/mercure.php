<?php
return [
    'url' => env('MERCURE_URL', 'http://mercure/.well-known/mercure'),
    'jwt' => [
        'secret' => '!ChangeThisMercureHubJWTSecretKey!',
        'publish' => ['foo', 'https://example.com/foo'],
        'subscribe' => ['bar', 'https://example.com/bar'],
        'algorithm' => 'hmac.sha256',
        'provider' => 'My\Provider',
        'factory' => 'My\Factory',
        'value' => env('MERCURE_PUBLISHER_JWT'),
    ],
];
