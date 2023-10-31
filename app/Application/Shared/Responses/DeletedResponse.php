<?php

namespace App\Application\Shared\Responses;

use Illuminate\Http\Response;

class DeletedResponse extends Response
{
    public string $message = 'Deleted Successfully.';
    public $content;

    public function setContent(mixed $content): static
    {
        $this->content = $content;
        $this->appendMessage();
        $this->setStatusCode(204);
        return parent::setContent($this->content);
    }

    private function appendMessage(): void
    {
        $this->content = [
            'success' => true,
            'message' => $this->message,
            'content' => $this->content
        ];
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }
}
