<?php

namespace Http;

final class Response
{
    private $responseCode;

    private $headers;

    private $body;

    public function __construct(int $responseCode, array $headers, string $body)
    {
        if (100 > $responseCode || 599 < $responseCode) {
            throw new \InvalidArgumentException(
                "Invalid response code '{$responseCode}'"
            );
        }
        $this->responseCode = $responseCode;
        $this->headers      = $headers;
        $this->body         = $body;
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function getHeaderLines(): array
    {
        $headers = [];
        foreach ($this->headers as $key => $value) {
            $headers[] = "{$key}: {$value}";
        }
        return $headers;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
