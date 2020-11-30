<?php

declare(strict_types = 1);

namespace Alexander1000\Clients\Content\Request\V1\Page;

use NetworkTransport;

class Save extends NetworkTransport\Http\Request\Data
{
    public function __construct(
        ?int $id,
        string $slug,
        ?int $contentId
    ) {
        parent::__construct(
            '/v1/page/save',
            'POST',
            [
                'Content-Type' => 'application/json'
            ],
            []
        );
        $this->data = [
            'id' => $id,
            'slug' => $slug,
            'contentId' => $contentId,
        ];
    }
}

