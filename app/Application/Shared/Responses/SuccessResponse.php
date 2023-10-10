<?php

namespace App\Application\Shared\Responses;

use Illuminate\Http\Response;

class SuccessResponse extends Response
{
    public string $message = 'Successful.';
    public $content;

    public function setContent(mixed $content): static
    {
        $this->content = $content;
        $this->appendMessage();
        return parent::setContent($this->content);
    }

    private function appendMessage()
    {
        $this->content = [
            'success' => true,
            'message' => $this->message,
            'content' => $this->content
        ];
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }
}
