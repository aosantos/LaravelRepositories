<?php

<<<<<<< HEAD
namespace GuzzleHttp\Psr7;

=======
declare(strict_types=1);

namespace GuzzleHttp\Psr7;

use Psr\Http\Message\MessageInterface;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
use Psr\Http\Message\StreamInterface;

/**
 * Trait implementing functionality common to requests and responses.
 */
trait MessageTrait
{
<<<<<<< HEAD
    /** @var array Map of all registered headers, as original name => array of values */
    private $headers = [];

    /** @var array Map of lowercase header name => original name at registration */
=======
    /** @var array<string, string[]> Map of all registered headers, as original name => array of values */
    private $headers = [];

    /** @var array<string, string> Map of lowercase header name => original name at registration */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $headerNames  = [];

    /** @var string */
    private $protocol = '1.1';

    /** @var StreamInterface|null */
    private $stream;

<<<<<<< HEAD
    public function getProtocolVersion()
=======
    public function getProtocolVersion(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->protocol;
    }

<<<<<<< HEAD
    public function withProtocolVersion($version)
=======
    public function withProtocolVersion($version): MessageInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($this->protocol === $version) {
            return $this;
        }

        $new = clone $this;
        $new->protocol = $version;
        return $new;
    }

<<<<<<< HEAD
    public function getHeaders()
=======
    public function getHeaders(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->headers;
    }

<<<<<<< HEAD
    public function hasHeader($header)
=======
    public function hasHeader($header): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return isset($this->headerNames[strtolower($header)]);
    }

<<<<<<< HEAD
    public function getHeader($header)
=======
    public function getHeader($header): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $header = strtolower($header);

        if (!isset($this->headerNames[$header])) {
            return [];
        }

        $header = $this->headerNames[$header];

        return $this->headers[$header];
    }

<<<<<<< HEAD
    public function getHeaderLine($header)
=======
    public function getHeaderLine($header): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return implode(', ', $this->getHeader($header));
    }

<<<<<<< HEAD
    public function withHeader($header, $value)
=======
    public function withHeader($header, $value): MessageInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->assertHeader($header);
        $value = $this->normalizeHeaderValue($value);
        $normalized = strtolower($header);

        $new = clone $this;
        if (isset($new->headerNames[$normalized])) {
            unset($new->headers[$new->headerNames[$normalized]]);
        }
        $new->headerNames[$normalized] = $header;
        $new->headers[$header] = $value;

        return $new;
    }

<<<<<<< HEAD
    public function withAddedHeader($header, $value)
=======
    public function withAddedHeader($header, $value): MessageInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->assertHeader($header);
        $value = $this->normalizeHeaderValue($value);
        $normalized = strtolower($header);

        $new = clone $this;
        if (isset($new->headerNames[$normalized])) {
            $header = $this->headerNames[$normalized];
            $new->headers[$header] = array_merge($this->headers[$header], $value);
        } else {
            $new->headerNames[$normalized] = $header;
            $new->headers[$header] = $value;
        }

        return $new;
    }

<<<<<<< HEAD
    public function withoutHeader($header)
=======
    public function withoutHeader($header): MessageInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $normalized = strtolower($header);

        if (!isset($this->headerNames[$normalized])) {
            return $this;
        }

        $header = $this->headerNames[$normalized];

        $new = clone $this;
        unset($new->headers[$header], $new->headerNames[$normalized]);

        return $new;
    }

<<<<<<< HEAD
    public function getBody()
=======
    public function getBody(): StreamInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!$this->stream) {
            $this->stream = Utils::streamFor('');
        }

        return $this->stream;
    }

<<<<<<< HEAD
    public function withBody(StreamInterface $body)
=======
    public function withBody(StreamInterface $body): MessageInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($body === $this->stream) {
            return $this;
        }

        $new = clone $this;
        $new->stream = $body;
        return $new;
    }

<<<<<<< HEAD
    private function setHeaders(array $headers)
=======
    /**
     * @param array<string|int, string|string[]> $headers
     */
    private function setHeaders(array $headers): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->headerNames = $this->headers = [];
        foreach ($headers as $header => $value) {
            if (is_int($header)) {
                // Numeric array keys are converted to int by PHP but having a header name '123' is not forbidden by the spec
                // and also allowed in withHeader(). So we need to cast it to string again for the following assertion to pass.
                $header = (string) $header;
            }
            $this->assertHeader($header);
            $value = $this->normalizeHeaderValue($value);
            $normalized = strtolower($header);
            if (isset($this->headerNames[$normalized])) {
                $header = $this->headerNames[$normalized];
                $this->headers[$header] = array_merge($this->headers[$header], $value);
            } else {
                $this->headerNames[$normalized] = $header;
                $this->headers[$header] = $value;
            }
        }
    }

<<<<<<< HEAD
    private function normalizeHeaderValue($value)
=======
    /**
     * @param mixed $value
     *
     * @return string[]
     */
    private function normalizeHeaderValue($value): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_array($value)) {
            return $this->trimHeaderValues([$value]);
        }

        if (count($value) === 0) {
            throw new \InvalidArgumentException('Header value can not be an empty array.');
        }

        return $this->trimHeaderValues($value);
    }

    /**
     * Trims whitespace from the header values.
     *
     * Spaces and tabs ought to be excluded by parsers when extracting the field value from a header field.
     *
     * header-field = field-name ":" OWS field-value OWS
     * OWS          = *( SP / HTAB )
     *
<<<<<<< HEAD
     * @param string[] $values Header values
=======
     * @param mixed[] $values Header values
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     *
     * @return string[] Trimmed header values
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.2.4
     */
<<<<<<< HEAD
    private function trimHeaderValues(array $values)
=======
    private function trimHeaderValues(array $values): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return array_map(function ($value) {
            if (!is_scalar($value) && null !== $value) {
                throw new \InvalidArgumentException(sprintf(
                    'Header value must be scalar or null but %s provided.',
                    is_object($value) ? get_class($value) : gettype($value)
                ));
            }

            return trim((string) $value, " \t");
        }, array_values($values));
    }

<<<<<<< HEAD
    private function assertHeader($header)
=======
    /**
     * @see https://tools.ietf.org/html/rfc7230#section-3.2
     *
     * @param mixed $header
     */
    private function assertHeader($header): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($header)) {
            throw new \InvalidArgumentException(sprintf(
                'Header name must be a string but %s provided.',
                is_object($header) ? get_class($header) : gettype($header)
            ));
        }

<<<<<<< HEAD
        if ($header === '') {
            throw new \InvalidArgumentException('Header name can not be empty.');
=======
        if (! preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/', $header)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '"%s" is not valid header name',
                    $header
                )
            );
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }
    }
}
