<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * PSR-7 response implementation.
 */
class Response implements ResponseInterface
{
    use MessageTrait;

<<<<<<< HEAD
    /** @var array Map of standard HTTP status code/reason phrases */
    private static $phrases = [
=======
    /** Map of standard HTTP status code/reason phrases */
    private const PHRASES = [
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
<<<<<<< HEAD
=======
        308 => 'Permanent Redirect',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
<<<<<<< HEAD
=======
        510 => 'Not Extended',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        511 => 'Network Authentication Required',
    ];

    /** @var string */
<<<<<<< HEAD
    private $reasonPhrase = '';

    /** @var int */
    private $statusCode = 200;

    /**
     * @param int                                  $status  Status code
     * @param array                                $headers Response headers
=======
    private $reasonPhrase;

    /** @var int */
    private $statusCode;

    /**
     * @param int                                  $status  Status code
     * @param array<string, string|string[]>       $headers Response headers
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @param string|resource|StreamInterface|null $body    Response body
     * @param string                               $version Protocol version
     * @param string|null                          $reason  Reason phrase (when empty a default will be used based on the status code)
     */
    public function __construct(
<<<<<<< HEAD
        $status = 200,
        array $headers = [],
        $body = null,
        $version = '1.1',
        $reason = null
    ) {
        $this->assertStatusCodeIsInteger($status);
        $status = (int) $status;
=======
        int $status = 200,
        array $headers = [],
        $body = null,
        string $version = '1.1',
        string $reason = null
    ) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $this->assertStatusCodeRange($status);

        $this->statusCode = $status;

        if ($body !== '' && $body !== null) {
            $this->stream = Utils::streamFor($body);
        }

        $this->setHeaders($headers);
<<<<<<< HEAD
        if ($reason == '' && isset(self::$phrases[$this->statusCode])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
=======
        if ($reason == '' && isset(self::PHRASES[$this->statusCode])) {
            $this->reasonPhrase = self::PHRASES[$this->statusCode];
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        } else {
            $this->reasonPhrase = (string) $reason;
        }

        $this->protocol = $version;
    }

<<<<<<< HEAD
    public function getStatusCode()
=======
    public function getStatusCode(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->statusCode;
    }

<<<<<<< HEAD
    public function getReasonPhrase()
=======
    public function getReasonPhrase(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->reasonPhrase;
    }

<<<<<<< HEAD
    public function withStatus($code, $reasonPhrase = '')
=======
    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->assertStatusCodeIsInteger($code);
        $code = (int) $code;
        $this->assertStatusCodeRange($code);

        $new = clone $this;
        $new->statusCode = $code;
<<<<<<< HEAD
        if ($reasonPhrase == '' && isset(self::$phrases[$new->statusCode])) {
            $reasonPhrase = self::$phrases[$new->statusCode];
=======
        if ($reasonPhrase == '' && isset(self::PHRASES[$new->statusCode])) {
            $reasonPhrase = self::PHRASES[$new->statusCode];
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }
        $new->reasonPhrase = (string) $reasonPhrase;
        return $new;
    }

<<<<<<< HEAD
    private function assertStatusCodeIsInteger($statusCode)
=======
    /**
     * @param mixed $statusCode
     */
    private function assertStatusCodeIsInteger($statusCode): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (filter_var($statusCode, FILTER_VALIDATE_INT) === false) {
            throw new \InvalidArgumentException('Status code must be an integer value.');
        }
    }

<<<<<<< HEAD
    private function assertStatusCodeRange($statusCode)
=======
    private function assertStatusCodeRange(int $statusCode): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($statusCode < 100 || $statusCode >= 600) {
            throw new \InvalidArgumentException('Status code must be an integer value between 1xx and 5xx.');
        }
    }
}
