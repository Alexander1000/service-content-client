<?php

declare(strict_types=1);

namespace Alexander1000\Clients\Content;

use NetworkTransport;

class Client
{
    public function __construct(
        protected NetworkTransport\Http\Transport $transport,
        protected NetworkTransport\Http\Request\Builder $requestBuilder,
    ) {}

    /**
     * @param NetworkTransport\Http\Request\Data $requestData
     * @return Response
     * @throws \Alexander1000\Clients\Content\Exception
     * @throws \NetworkTransport\Http\Exception\MethodNotAllowed
     */
    protected function executeRequest(NetworkTransport\Http\Request\Data $requestData): Response
    {
        $response = $this->transport->send(
            new NetworkTransport\Http\Request($this->requestBuilder, $requestData)
        );

        if ($response->isError()) {
            throw new Exception(
                $response->getErrorMessage() ?? '',
                $response->getErrorCode() ?? 500
            );
        }

        $data = json_decode($response->getResponse() ?? '', true);
        if (json_last_error()) {
            throw new Exception('cannot parse response', 501);
        }

        $errCode = null;
        $errMsg = null;

        if (isset($data['error'])) {
            $errCode = (int) $data['error']['code'];
            $errMsg = $data['error']['message'];
        }

        return new Response($data['result'] ?? null, $errCode, $errMsg);
    }
}
