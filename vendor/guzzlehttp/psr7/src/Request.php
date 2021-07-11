<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * PSR-7 request implementation.
 */
class Request implements RequestInterface
{
    use MessageTrait;

    /** @var string */
    private $method;

    /** @var string|null */
    private $requestTarget;

    /** @var UriInterface */
    private $uri;

    /**
     * @param string                               $method  HTTP method
     * @param string|UriInterface                  $uri     URI
<<<<<<< HEAD
     * @param array                                $headers Request headers
=======
     * @param array<string, string|string[]>       $headers Request headers
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @param string|resource|StreamInterface|null $body    Request body
     * @param string                               $version Protocol version
     */
    public function __construct(
<<<<<<< HEAD
        $method,
        $uri,
        array $headers = [],
        $body = null,
        $version = '1.1'
=======
        string $method,
        $uri,
        array $headers = [],
        $body = null,
        string $version = '1.1'
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    ) {
        $this->assertMethod($method);
        if (!($uri instanceof UriInterface)) {
            $uri = new Uri($uri);
        }

        $this->method = strtoupper($method);
        $this->uri = $uri;
        $this->setHeaders($headers);
        $this->protocol = $version;

        if (!isset($this->headerNames['host'])) {
            $this->updateHostFromUri();
        }

        if ($body !== '' && $body !== null) {
            $this->stream = Utils::streamFor($body);
        }
    }

<<<<<<< HEAD
    public function getRequestTarget()
=======
    public function getRequestTarget(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($this->requestTarget !== null) {
            return $this->requestTarget;
        }

        $target = $this->uri->getPath();
<<<<<<< HEAD
        if ($target == '') {
=======
        if ($target === '') {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            $target = '/';
        }
        if ($this->uri->getQuery() != '') {
            $target .= '?' . $this->uri->getQuery();
        }

        return $target;
    }

<<<<<<< HEAD
    public function withRequestTarget($requestTarget)
=======
    public function withRequestTarget($requestTarget): RequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (preg_match('#\s#', $requestTarget)) {
            throw new InvalidArgumentException(
                'Invalid request target provided; cannot contain whitespace'
            );
        }

        $new = clone $this;
        $new->requestTarget = $requestTarget;
        return $new;
    }

<<<<<<< HEAD
    public function getMethod()
=======
    public function getMethod(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->method;
    }

<<<<<<< HEAD
    public function withMethod($method)
=======
    public function withMethod($method): RequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->assertMethod($method);
        $new = clone $this;
        $new->method = strtoupper($method);
        return $new;
    }

<<<<<<< HEAD
    public function getUri()
=======
    public function getUri(): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->uri;
    }

<<<<<<< HEAD
    public function withUri(UriInterface $uri, $preserveHost = false)
=======
    public function withUri(UriInterface $uri, $preserveHost = false): RequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($uri === $this->uri) {
            return $this;
        }

        $new = clone $this;
        $new->uri = $uri;

        if (!$preserveHost || !isset($this->headerNames['host'])) {
            $new->updateHostFromUri();
        }

        return $new;
    }

<<<<<<< HEAD
    private function updateHostFromUri()
=======
    private function updateHostFromUri(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $host = $this->uri->getHost();

        if ($host == '') {
            return;
        }

        if (($port = $this->uri->getPort()) !== null) {
            $host .= ':' . $port;
        }

        if (isset($this->headerNames['host'])) {
            $header = $this->headerNames['host'];
        } else {
            $header = 'Host';
            $this->headerNames['host'] = 'Host';
        }
        // Ensure Host is the first header.
        // See: http://tools.ietf.org/html/rfc7230#section-5.4
        $this->headers = [$header => [$host]] + $this->headers;
    }

<<<<<<< HEAD
    private function assertMethod($method)
=======
    /**
     * @param mixed $method
     */
    private function assertMethod($method): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($method) || $method === '') {
            throw new \InvalidArgumentException('Method must be a non-empty string.');
        }
    }
}
