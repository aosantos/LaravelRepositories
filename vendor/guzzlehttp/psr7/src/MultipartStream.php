<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Stream that when read returns bytes for a streaming multipart or
 * multipart/form-data stream.
<<<<<<< HEAD
 *
 * @final
 */
class MultipartStream implements StreamInterface
{
    use StreamDecoratorTrait;

=======
 */
final class MultipartStream implements StreamInterface
{
    use StreamDecoratorTrait;

    /** @var string */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $boundary;

    /**
     * @param array  $elements Array of associative arrays, each containing a
     *                         required "name" key mapping to the form field,
     *                         name, a required "contents" key mapping to a
     *                         StreamInterface/resource/string, an optional
     *                         "headers" associative array of custom headers,
     *                         and an optional "filename" key mapping to a
     *                         string to send as the filename in the part.
     * @param string $boundary You can optionally provide a specific boundary
     *
     * @throws \InvalidArgumentException
     */
<<<<<<< HEAD
    public function __construct(array $elements = [], $boundary = null)
=======
    public function __construct(array $elements = [], string $boundary = null)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->boundary = $boundary ?: sha1(uniqid('', true));
        $this->stream = $this->createStream($elements);
    }

<<<<<<< HEAD
    /**
     * Get the boundary
     *
     * @return string
     */
    public function getBoundary()
=======
    public function getBoundary(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->boundary;
    }

<<<<<<< HEAD
    public function isWritable()
=======
    public function isWritable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return false;
    }

    /**
     * Get the headers needed before transferring the content of a POST file
<<<<<<< HEAD
     */
    private function getHeaders(array $headers)
=======
     *
     * @param array<string, string> $headers
     */
    private function getHeaders(array $headers): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $str = '';
        foreach ($headers as $key => $value) {
            $str .= "{$key}: {$value}\r\n";
        }

        return "--{$this->boundary}\r\n" . trim($str) . "\r\n\r\n";
    }

    /**
     * Create the aggregate stream that will be used to upload the POST data
     */
<<<<<<< HEAD
    protected function createStream(array $elements)
=======
    protected function createStream(array $elements = []): StreamInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $stream = new AppendStream();

        foreach ($elements as $element) {
            $this->addElement($stream, $element);
        }

        // Add the trailing boundary with CRLF
        $stream->addStream(Utils::streamFor("--{$this->boundary}--\r\n"));

        return $stream;
    }

<<<<<<< HEAD
    private function addElement(AppendStream $stream, array $element)
=======
    private function addElement(AppendStream $stream, array $element): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        foreach (['contents', 'name'] as $key) {
            if (!array_key_exists($key, $element)) {
                throw new \InvalidArgumentException("A '{$key}' key is required");
            }
        }

        $element['contents'] = Utils::streamFor($element['contents']);

        if (empty($element['filename'])) {
            $uri = $element['contents']->getMetadata('uri');
            if (substr($uri, 0, 6) !== 'php://') {
                $element['filename'] = $uri;
            }
        }

<<<<<<< HEAD
        list($body, $headers) = $this->createElement(
            $element['name'],
            $element['contents'],
            isset($element['filename']) ? $element['filename'] : null,
            isset($element['headers']) ? $element['headers'] : []
=======
        [$body, $headers] = $this->createElement(
            $element['name'],
            $element['contents'],
            $element['filename'] ?? null,
            $element['headers'] ?? []
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        );

        $stream->addStream(Utils::streamFor($this->getHeaders($headers)));
        $stream->addStream($body);
        $stream->addStream(Utils::streamFor("\r\n"));
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    private function createElement($name, StreamInterface $stream, $filename, array $headers)
=======
    private function createElement(string $name, StreamInterface $stream, ?string $filename, array $headers): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        // Set a default content-disposition header if one was no provided
        $disposition = $this->getHeader($headers, 'content-disposition');
        if (!$disposition) {
            $headers['Content-Disposition'] = ($filename === '0' || $filename)
                ? sprintf(
                    'form-data; name="%s"; filename="%s"',
                    $name,
                    basename($filename)
                )
                : "form-data; name=\"{$name}\"";
        }

        // Set a default content-length header if one was no provided
        $length = $this->getHeader($headers, 'content-length');
        if (!$length) {
            if ($length = $stream->getSize()) {
                $headers['Content-Length'] = (string) $length;
            }
        }

        // Set a default Content-Type if one was not supplied
        $type = $this->getHeader($headers, 'content-type');
        if (!$type && ($filename === '0' || $filename)) {
            if ($type = MimeType::fromFilename($filename)) {
                $headers['Content-Type'] = $type;
            }
        }

        return [$stream, $headers];
    }

<<<<<<< HEAD
    private function getHeader(array $headers, $key)
=======
    private function getHeader(array $headers, string $key)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $lowercaseHeader = strtolower($key);
        foreach ($headers as $k => $v) {
            if (strtolower($k) === $lowercaseHeader) {
                return $v;
            }
        }

        return null;
    }
}
