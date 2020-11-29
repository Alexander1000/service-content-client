<?php

declare(strict_types = 1);

namespace Alexander1000\Clients\Content\Request\V1\Content;

use NetworkTransport;

class Save extends NetworkTransport\Http\Request\Data
{
    public function __construct(
        ?int $id,
        string $title,
        string $text,
        int $userId,
    ) {
        parent::__construct(
            '/v1/content/save',
            'POST',
            [
                'Content-Type' => 'application/json',
            ],
            []
        );
        $this->data = [
            'id' => $id,
            'title' => $title,
            'text' => $text,
            'userId' => $userId,
        ];
    }
}

