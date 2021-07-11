<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

/**
 * Server-side HTTP request
 *
 * Extends the Request definition to add methods for accessing incoming data,
 * specifically server parameters, cookies, matched path parameters, query
 * string arguments, body parameters, and upload file information.
 *
 * "Attributes" are discovered via decomposing the request (and usually
 * specifically the URI path), and typically will be injected by the application.
 *
 * Requests are considered immutable; all methods that might change state are
 * implemented such that they retain the internal state of the current
 * message and return a new instance that contains the changed state.
 */
class ServerRequest extends Request implements ServerRequestInterface
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $cookieParams = [];

    /**
     * @var array|object|null
     */
    private $parsedBody;

    /**
     * @var array
     */
    private $queryParams = [];

    /**
     * @var array
     */
    private $serverParams;

    /**
     * @var array
     */
    private $uploadedFiles = [];

    /**
     * @param string                               $method       HTTP method
     * @param string|UriInterface                  $uri          URI
<<<<<<< HEAD
     * @param array                                $headers      Request headers
=======
     * @param array<string, string|string[]>       $headers      Request headers
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @param string|resource|StreamInterface|null $body         Request body
     * @param string                               $version      Protocol version
     * @param array                                $serverParams Typically the $_SERVER superglobal
     */
    public function __construct(
<<<<<<< HEAD
        $method,
        $uri,
        array $headers = [],
        $body = null,
        $version = '1.1',
=======
        string $method,
        $uri,
        array $headers = [],
        $body = null,
        string $version = '1.1',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        array $serverParams = []
    ) {
        $this->serverParams = $serverParams;

        parent::__construct($method, $uri, $headers, $body, $version);
    }

    /**
     * Return an UploadedFile instance array.
     *
     * @param array $files A array which respect $_FILES structure
     *
<<<<<<< HEAD
     * @return array
     *
     * @throws InvalidArgumentException for unrecognized values
     */
    public static function normalizeFiles(array $files)
=======
     * @throws InvalidArgumentException for unrecognized values
     */
    public static function normalizeFiles(array $files): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $normalized = [];

        foreach ($files as $key => $value) {
            if ($value instanceof UploadedFileInterface) {
                $normalized[$key] = $value;
            } elseif (is_array($value) && isset($value['tmp_name'])) {
                $normalized[$key] = self::createUploadedFileFromSpec($value);
            } elseif (is_array($value)) {
                $normalized[$key] = self::normalizeFiles($value);
                continue;
            } else {
                throw new InvalidArgumentException('Invalid value in files specification');
            }
        }

        return $normalized;
    }

    /**
     * Create and return an UploadedFile instance from a $_FILES specification.
     *
     * If the specification represents an array of values, this method will
     * delegate to normalizeNestedFileSpec() and return that return value.
     *
     * @param array $value $_FILES struct
     *
<<<<<<< HEAD
     * @return array|UploadedFileInterface
=======
     * @return UploadedFileInterface|UploadedFileInterface[]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private static function createUploadedFileFromSpec(array $value)
    {
        if (is_array($value['tmp_name'])) {
            return self::normalizeNestedFileSpec($value);
        }

        return new UploadedFile(
            $value['tmp_name'],
            (int) $value['size'],
            (int) $value['error'],
            $value['name'],
            $value['type']
        );
    }

    /**
     * Normalize an array of file specifications.
     *
     * Loops through all nested files and returns a normalized array of
     * UploadedFileInterface instances.
     *
<<<<<<< HEAD
     * @param array $files
     *
     * @return UploadedFileInterface[]
     */
    private static function normalizeNestedFileSpec(array $files = [])
=======
     * @return UploadedFileInterface[]
     */
    private static function normalizeNestedFileSpec(array $files = []): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $normalizedFiles = [];

        foreach (array_keys($files['tmp_name']) as $key) {
            $spec = [
                'tmp_name' => $files['tmp_name'][$key],
                'size'     => $files['size'][$key],
                'error'    => $files['error'][$key],
                'name'     => $files['name'][$key],
                'type'     => $files['type'][$key],
            ];
            $normalizedFiles[$key] = self::createUploadedFileFromSpec($spec);
        }

        return $normalizedFiles;
    }

    /**
     * Return a ServerRequest populated with superglobals:
     * $_GET
     * $_POST
     * $_COOKIE
     * $_FILES
     * $_SERVER
<<<<<<< HEAD
     *
     * @return ServerRequestInterface
     */
    public static function fromGlobals()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
=======
     */
    public static function fromGlobals(): ServerRequestInterface
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $headers = getallheaders();
        $uri = self::getUriFromGlobals();
        $body = new CachingStream(new LazyOpenStream('php://input', 'r+'));
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? str_replace('HTTP/', '', $_SERVER['SERVER_PROTOCOL']) : '1.1';

        $serverRequest = new ServerRequest($method, $uri, $headers, $body, $protocol, $_SERVER);

        return $serverRequest
            ->withCookieParams($_COOKIE)
            ->withQueryParams($_GET)
            ->withParsedBody($_POST)
            ->withUploadedFiles(self::normalizeFiles($_FILES));
    }

<<<<<<< HEAD
    private static function extractHostAndPortFromAuthority($authority)
=======
    private static function extractHostAndPortFromAuthority(string $authority): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $uri = 'http://' . $authority;
        $parts = parse_url($uri);
        if (false === $parts) {
            return [null, null];
        }

<<<<<<< HEAD
        $host = isset($parts['host']) ? $parts['host'] : null;
        $port = isset($parts['port']) ? $parts['port'] : null;
=======
        $host = $parts['host'] ?? null;
        $port = $parts['port'] ?? null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        return [$host, $port];
    }

    /**
     * Get a Uri populated with values from $_SERVER.
<<<<<<< HEAD
     *
     * @return UriInterface
     */
    public static function getUriFromGlobals()
=======
     */
    public static function getUriFromGlobals(): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $uri = new Uri('');

        $uri = $uri->withScheme(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');

        $hasPort = false;
        if (isset($_SERVER['HTTP_HOST'])) {
<<<<<<< HEAD
            list($host, $port) = self::extractHostAndPortFromAuthority($_SERVER['HTTP_HOST']);
=======
            [$host, $port] = self::extractHostAndPortFromAuthority($_SERVER['HTTP_HOST']);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            if ($host !== null) {
                $uri = $uri->withHost($host);
            }

            if ($port !== null) {
                $hasPort = true;
                $uri = $uri->withPort($port);
            }
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $uri = $uri->withHost($_SERVER['SERVER_NAME']);
        } elseif (isset($_SERVER['SERVER_ADDR'])) {
            $uri = $uri->withHost($_SERVER['SERVER_ADDR']);
        }

        if (!$hasPort && isset($_SERVER['SERVER_PORT'])) {
            $uri = $uri->withPort($_SERVER['SERVER_PORT']);
        }

        $hasQuery = false;
        if (isset($_SERVER['REQUEST_URI'])) {
            $requestUriParts = explode('?', $_SERVER['REQUEST_URI'], 2);
            $uri = $uri->withPath($requestUriParts[0]);
            if (isset($requestUriParts[1])) {
                $hasQuery = true;
                $uri = $uri->withQuery($requestUriParts[1]);
            }
        }

        if (!$hasQuery && isset($_SERVER['QUERY_STRING'])) {
            $uri = $uri->withQuery($_SERVER['QUERY_STRING']);
        }

        return $uri;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getServerParams()
=======
    public function getServerParams(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->serverParams;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getUploadedFiles()
=======
    public function getUploadedFiles(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->uploadedFiles;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withUploadedFiles(array $uploadedFiles)
=======
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $new = clone $this;
        $new->uploadedFiles = $uploadedFiles;

        return $new;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getCookieParams()
=======
    public function getCookieParams(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->cookieParams;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withCookieParams(array $cookies)
=======
    public function withCookieParams(array $cookies): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $new = clone $this;
        $new->cookieParams = $cookies;

        return $new;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getQueryParams()
=======
    public function getQueryParams(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->queryParams;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withQueryParams(array $query)
=======
    public function withQueryParams(array $query): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $new = clone $this;
        $new->queryParams = $query;

        return $new;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function getParsedBody()
    {
        return $this->parsedBody;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withParsedBody($data)
=======
    public function withParsedBody($data): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $new = clone $this;
        $new->parsedBody = $data;

        return $new;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
=======
    public function getAttributes(): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->attributes;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function getAttribute($attribute, $default = null)
    {
        if (false === array_key_exists($attribute, $this->attributes)) {
            return $default;
        }

        return $this->attributes[$attribute];
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withAttribute($attribute, $value)
=======
    public function withAttribute($attribute, $value): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $new = clone $this;
        $new->attributes[$attribute] = $value;

        return $new;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function withoutAttribute($attribute)
=======
    public function withoutAttribute($attribute): ServerRequestInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (false === array_key_exists($attribute, $this->attributes)) {
            return $this;
        }

        $new = clone $this;
        unset($new->attributes[$attribute]);

        return $new;
    }
}
