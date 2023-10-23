<?php

namespace App\Application\Shared\Responses;

use Illuminate\Http\Response;

class ErrorResponse extends Response
{
    public string $message = 'Error';
    public $content;

    public function setContent(mixed $content): static
    {
        $this->content = [
            'success' => false,
            'message' => $content
        ];

        return parent::setContent($this->content);
    }

}
