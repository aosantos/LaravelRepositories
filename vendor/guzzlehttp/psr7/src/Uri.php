<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\UriInterface;

/**
 * PSR-7 URI implementation.
 *
 * @author Michael Dowling
 * @author Tobias Schultze
 * @author Matthew Weier O'Phinney
 */
class Uri implements UriInterface
{
    /**
     * Absolute http and https URIs require a host per RFC 7230 Section 2.7
     * but in generic URIs the host can be empty. So for http(s) URIs
     * we apply this default host when no host is given yet to form a
     * valid URI.
     */
<<<<<<< HEAD
    const HTTP_DEFAULT_HOST = 'localhost';

    private static $defaultPorts = [
=======
    private const HTTP_DEFAULT_HOST = 'localhost';

    private const DEFAULT_PORTS = [
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        'http'  => 80,
        'https' => 443,
        'ftp' => 21,
        'gopher' => 70,
        'nntp' => 119,
        'news' => 119,
        'telnet' => 23,
        'tn3270' => 23,
        'imap' => 143,
        'pop' => 110,
        'ldap' => 389,
    ];

<<<<<<< HEAD
    private static $charUnreserved = 'a-zA-Z0-9_\-\.~';
    private static $charSubDelims = '!\$&\'\(\)\*\+,;=';
    private static $replaceQuery = ['=' => '%3D', '&' => '%26'];
=======
    /**
     * Unreserved characters for use in a regex.
     *
     * @link https://tools.ietf.org/html/rfc3986#section-2.3
     */
    private const CHAR_UNRESERVED = 'a-zA-Z0-9_\-\.~';

    /**
     * Sub-delims for use in a regex.
     *
     * @link https://tools.ietf.org/html/rfc3986#section-2.2
     */
    private const CHAR_SUB_DELIMS = '!\$&\'\(\)\*\+,;=';
    private const QUERY_SEPARATORS_REPLACEMENT = ['=' => '%3D', '&' => '%26'];
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

    /** @var string Uri scheme. */
    private $scheme = '';

    /** @var string Uri user info. */
    private $userInfo = '';

    /** @var string Uri host. */
    private $host = '';

    /** @var int|null Uri port. */
    private $port;

    /** @var string Uri path. */
    private $path = '';

    /** @var string Uri query string. */
    private $query = '';

    /** @var string Uri fragment. */
    private $fragment = '';

<<<<<<< HEAD
    /**
     * @param string $uri URI to parse
     */
    public function __construct($uri = '')
    {
        // weak type check to also accept null until we can add scalar type hints
        if ($uri != '') {
=======
    /** @var string|null String representation */
    private $composedComponents;

    public function __construct(string $uri = '')
    {
        if ($uri !== '') {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            $parts = self::parse($uri);
            if ($parts === false) {
                throw new \InvalidArgumentException("Unable to parse URI: $uri");
            }
            $this->applyParts($parts);
        }
    }
<<<<<<< HEAD

=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    /**
     * UTF-8 aware \parse_url() replacement.
     *
     * The internal function produces broken output for non ASCII domain names
     * (IDN) when used with locales other than "C".
     *
     * On the other hand, cURL understands IDN correctly only when UTF-8 locale
     * is configured ("C.UTF-8", "en_US.UTF-8", etc.).
     *
     * @see https://bugs.php.net/bug.php?id=52923
     * @see https://www.php.net/manual/en/function.parse-url.php#114817
     * @see https://curl.haxx.se/libcurl/c/CURLOPT_URL.html#ENCODING
     *
<<<<<<< HEAD
     * @param string $url
     *
     * @return array|false
     */
    private static function parse($url)
=======
     * @return array|false
     */
    private static function parse(string $url)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        // If IPv6
        $prefix = '';
        if (preg_match('%^(.*://\[[0-9:a-f]+\])(.*?)$%', $url, $matches)) {
<<<<<<< HEAD
=======
            /** @var array{0:string, 1:string, 2:string} $matches */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            $prefix = $matches[1];
            $url = $matches[2];
        }

<<<<<<< HEAD
=======
        /** @var string */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $encodedUrl = preg_replace_callback(
            '%[^:/@?&=#]+%usD',
            static function ($matches) {
                return urlencode($matches[0]);
            },
            $url
        );

        $result = parse_url($prefix . $encodedUrl);

        if ($result === false) {
            return false;
        }

        return array_map('urldecode', $result);
    }

<<<<<<< HEAD
    public function __toString()
    {
        return self::composeComponents(
            $this->scheme,
            $this->getAuthority(),
            $this->path,
            $this->query,
            $this->fragment
        );
=======
    public function __toString(): string
    {
        if ($this->composedComponents === null) {
            $this->composedComponents = self::composeComponents(
                $this->scheme,
                $this->getAuthority(),
                $this->path,
                $this->query,
                $this->fragment
            );
        }

        return $this->composedComponents;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    }

    /**
     * Composes a URI reference string from its various components.
     *
     * Usually this method does not need to be called manually but instead is used indirectly via
     * `Psr\Http\Message\UriInterface::__toString`.
     *
     * PSR-7 UriInterface treats an empty component the same as a missing component as
     * getQuery(), getFragment() etc. always return a string. This explains the slight
     * difference to RFC 3986 Section 5.3.
     *
     * Another adjustment is that the authority separator is added even when the authority is missing/empty
     * for the "file" scheme. This is because PHP stream functions like `file_get_contents` only work with
     * `file:///myfile` but not with `file:/myfile` although they are equivalent according to RFC 3986. But
     * `file:///` is the more common syntax for the file scheme anyway (Chrome for example redirects to
     * that format).
     *
<<<<<<< HEAD
     * @param string $scheme
     * @param string $authority
     * @param string $path
     * @param string $query
     * @param string $fragment
     *
     * @return string
     *
     * @link https://tools.ietf.org/html/rfc3986#section-5.3
     */
    public static function composeComponents($scheme, $authority, $path, $query, $fragment)
=======
     * @link https://tools.ietf.org/html/rfc3986#section-5.3
     */
    public static function composeComponents(?string $scheme, ?string $authority, string $path, ?string $query, ?string $fragment): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $uri = '';

        // weak type checks to also accept null until we can add scalar type hints
        if ($scheme != '') {
            $uri .= $scheme . ':';
        }

        if ($authority != ''|| $scheme === 'file') {
            $uri .= '//' . $authority;
        }

        $uri .= $path;

        if ($query != '') {
            $uri .= '?' . $query;
        }

        if ($fragment != '') {
            $uri .= '#' . $fragment;
        }

        return $uri;
    }

    /**
     * Whether the URI has the default port of the current scheme.
     *
     * `Psr\Http\Message\UriInterface::getPort` may return null or the standard port. This method can be used
     * independently of the implementation.
<<<<<<< HEAD
     *
     * @param UriInterface $uri
     *
     * @return bool
     */
    public static function isDefaultPort(UriInterface $uri)
    {
        return $uri->getPort() === null
            || (isset(self::$defaultPorts[$uri->getScheme()]) && $uri->getPort() === self::$defaultPorts[$uri->getScheme()]);
=======
     */
    public static function isDefaultPort(UriInterface $uri): bool
    {
        return $uri->getPort() === null
            || (isset(self::DEFAULT_PORTS[$uri->getScheme()]) && $uri->getPort() === self::DEFAULT_PORTS[$uri->getScheme()]);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    }

    /**
     * Whether the URI is absolute, i.e. it has a scheme.
     *
     * An instance of UriInterface can either be an absolute URI or a relative reference. This method returns true
     * if it is the former. An absolute URI has a scheme. A relative reference is used to express a URI relative
     * to another URI, the base URI. Relative references can be divided into several forms:
     * - network-path references, e.g. '//example.com/path'
     * - absolute-path references, e.g. '/path'
     * - relative-path references, e.g. 'subpath'
     *
<<<<<<< HEAD
     * @param UriInterface $uri
     *
     * @return bool
     *
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @see Uri::isNetworkPathReference
     * @see Uri::isAbsolutePathReference
     * @see Uri::isRelativePathReference
     * @link https://tools.ietf.org/html/rfc3986#section-4
     */
<<<<<<< HEAD
    public static function isAbsolute(UriInterface $uri)
=======
    public static function isAbsolute(UriInterface $uri): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $uri->getScheme() !== '';
    }

    /**
     * Whether the URI is a network-path reference.
     *
     * A relative reference that begins with two slash characters is termed an network-path reference.
     *
<<<<<<< HEAD
     * @param UriInterface $uri
     *
     * @return bool
     *
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isNetworkPathReference(UriInterface $uri)
=======
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isNetworkPathReference(UriInterface $uri): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $uri->getScheme() === '' && $uri->getAuthority() !== '';
    }

    /**
     * Whether the URI is a absolute-path reference.
     *
     * A relative reference that begins with a single slash character is termed an absolute-path reference.
     *
<<<<<<< HEAD
     * @param UriInterface $uri
     *
     * @return bool
     *
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isAbsolutePathReference(UriInterface $uri)
=======
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isAbsolutePathReference(UriInterface $uri): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $uri->getScheme() === ''
            && $uri->getAuthority() === ''
            && isset($uri->getPath()[0])
            && $uri->getPath()[0] === '/';
    }

    /**
     * Whether the URI is a relative-path reference.
     *
     * A relative reference that does not begin with a slash character is termed a relative-path reference.
     *
<<<<<<< HEAD
     * @param UriInterface $uri
     *
     * @return bool
     *
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isRelativePathReference(UriInterface $uri)
=======
     * @link https://tools.ietf.org/html/rfc3986#section-4.2
     */
    public static function isRelativePathReference(UriInterface $uri): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $uri->getScheme() === ''
            && $uri->getAuthority() === ''
            && (!isset($uri->getPath()[0]) || $uri->getPath()[0] !== '/');
    }

    /**
     * Whether the URI is a same-document reference.
     *
     * A same-document reference refers to a URI that is, aside from its fragment
     * component, identical to the base URI. When no base URI is given, only an empty
     * URI reference (apart from its fragment) is considered a same-document reference.
     *
     * @param UriInterface      $uri  The URI to check
     * @param UriInterface|null $base An optional base URI to compare against
     *
<<<<<<< HEAD
     * @return bool
     *
     * @link https://tools.ietf.org/html/rfc3986#section-4.4
     */
    public static function isSameDocumentReference(UriInterface $uri, UriInterface $base = null)
=======
     * @link https://tools.ietf.org/html/rfc3986#section-4.4
     */
    public static function isSameDocumentReference(UriInterface $uri, UriInterface $base = null): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($base !== null) {
            $uri = UriResolver::resolve($base, $uri);

            return ($uri->getScheme() === $base->getScheme())
                && ($uri->getAuthority() === $base->getAuthority())
                && ($uri->getPath() === $base->getPath())
                && ($uri->getQuery() === $base->getQuery());
        }

        return $uri->getScheme() === '' && $uri->getAuthority() === '' && $uri->getPath() === '' && $uri->getQuery() === '';
    }

    /**
<<<<<<< HEAD
     * Removes dot segments from a path and returns the new path.
     *
     * @param string $path
     *
     * @return string
     *
     * @deprecated since version 1.4. Use UriResolver::removeDotSegments instead.
     * @see UriResolver::removeDotSegments
     */
    public static function removeDotSegments($path)
    {
        return UriResolver::removeDotSegments($path);
    }

    /**
     * Converts the relative URI into a new URI that is resolved against the base URI.
     *
     * @param UriInterface        $base Base URI
     * @param string|UriInterface $rel  Relative URI
     *
     * @return UriInterface
     *
     * @deprecated since version 1.4. Use UriResolver::resolve instead.
     * @see UriResolver::resolve
     */
    public static function resolve(UriInterface $base, $rel)
    {
        if (!($rel instanceof UriInterface)) {
            $rel = new self($rel);
        }

        return UriResolver::resolve($base, $rel);
    }

    /**
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * Creates a new URI with a specific query string value removed.
     *
     * Any existing query string values that exactly match the provided key are
     * removed.
     *
     * @param UriInterface $uri URI to use as a base.
     * @param string       $key Query string key to remove.
<<<<<<< HEAD
     *
     * @return UriInterface
     */
    public static function withoutQueryValue(UriInterface $uri, $key)
=======
     */
    public static function withoutQueryValue(UriInterface $uri, string $key): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $result = self::getFilteredQueryString($uri, [$key]);

        return $uri->withQuery(implode('&', $result));
    }

    /**
     * Creates a new URI with a specific query string value.
     *
     * Any existing query string values that exactly match the provided key are
     * removed and replaced with the given key value pair.
     *
     * A value of null will set the query string key without a value, e.g. "key"
     * instead of "key=value".
     *
     * @param UriInterface $uri   URI to use as a base.
     * @param string       $key   Key to set.
     * @param string|null  $value Value to set
<<<<<<< HEAD
     *
     * @return UriInterface
     */
    public static function withQueryValue(UriInterface $uri, $key, $value)
=======
     */
    public static function withQueryValue(UriInterface $uri, string $key, ?string $value): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $result = self::getFilteredQueryString($uri, [$key]);

        $result[] = self::generateQueryString($key, $value);

        return $uri->withQuery(implode('&', $result));
    }

    /**
     * Creates a new URI with multiple specific query string values.
     *
     * It has the same behavior as withQueryValue() but for an associative array of key => value.
     *
<<<<<<< HEAD
     * @param UriInterface $uri           URI to use as a base.
     * @param array        $keyValueArray Associative array of key and values
     *
     * @return UriInterface
     */
    public static function withQueryValues(UriInterface $uri, array $keyValueArray)
=======
     * @param UriInterface               $uri           URI to use as a base.
     * @param array<string, string|null> $keyValueArray Associative array of key and values
     */
    public static function withQueryValues(UriInterface $uri, array $keyValueArray): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $result = self::getFilteredQueryString($uri, array_keys($keyValueArray));

        foreach ($keyValueArray as $key => $value) {
<<<<<<< HEAD
            $result[] = self::generateQueryString($key, $value);
=======
            $result[] = self::generateQueryString((string) $key, $value !== null ? (string) $value : null);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }

        return $uri->withQuery(implode('&', $result));
    }

    /**
     * Creates a URI from a hash of `parse_url` components.
     *
<<<<<<< HEAD
     * @param array $parts
     *
     * @return UriInterface
     *
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @link http://php.net/manual/en/function.parse-url.php
     *
     * @throws \InvalidArgumentException If the components do not form a valid URI.
     */
<<<<<<< HEAD
    public static function fromParts(array $parts)
=======
    public static function fromParts(array $parts): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $uri = new self();
        $uri->applyParts($parts);
        $uri->validateState();

        return $uri;
    }

<<<<<<< HEAD
    public function getScheme()
=======
    public function getScheme(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->scheme;
    }

<<<<<<< HEAD
    public function getAuthority()
=======
    public function getAuthority(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $authority = $this->host;
        if ($this->userInfo !== '') {
            $authority = $this->userInfo . '@' . $authority;
        }

        if ($this->port !== null) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }

<<<<<<< HEAD
    public function getUserInfo()
=======
    public function getUserInfo(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->userInfo;
    }

<<<<<<< HEAD
    public function getHost()
=======
    public function getHost(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->host;
    }

<<<<<<< HEAD
    public function getPort()
=======
    public function getPort(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->port;
    }

<<<<<<< HEAD
    public function getPath()
=======
    public function getPath(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->path;
    }

<<<<<<< HEAD
    public function getQuery()
=======
    public function getQuery(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->query;
    }

<<<<<<< HEAD
    public function getFragment()
=======
    public function getFragment(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->fragment;
    }

<<<<<<< HEAD
    public function withScheme($scheme)
=======
    public function withScheme($scheme): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $scheme = $this->filterScheme($scheme);

        if ($this->scheme === $scheme) {
            return $this;
        }

        $new = clone $this;
        $new->scheme = $scheme;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $new->removeDefaultPort();
        $new->validateState();

        return $new;
    }

<<<<<<< HEAD
    public function withUserInfo($user, $password = null)
=======
    public function withUserInfo($user, $password = null): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $info = $this->filterUserInfoComponent($user);
        if ($password !== null) {
            $info .= ':' . $this->filterUserInfoComponent($password);
        }

        if ($this->userInfo === $info) {
            return $this;
        }

        $new = clone $this;
        $new->userInfo = $info;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $new->validateState();

        return $new;
    }

<<<<<<< HEAD
    public function withHost($host)
=======
    public function withHost($host): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $host = $this->filterHost($host);

        if ($this->host === $host) {
            return $this;
        }

        $new = clone $this;
        $new->host = $host;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $new->validateState();

        return $new;
    }

<<<<<<< HEAD
    public function withPort($port)
=======
    public function withPort($port): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $port = $this->filterPort($port);

        if ($this->port === $port) {
            return $this;
        }

        $new = clone $this;
        $new->port = $port;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $new->removeDefaultPort();
        $new->validateState();

        return $new;
    }

<<<<<<< HEAD
    public function withPath($path)
=======
    public function withPath($path): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $path = $this->filterPath($path);

        if ($this->path === $path) {
            return $this;
        }

        $new = clone $this;
        $new->path = $path;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $new->validateState();

        return $new;
    }

<<<<<<< HEAD
    public function withQuery($query)
=======
    public function withQuery($query): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $query = $this->filterQueryAndFragment($query);

        if ($this->query === $query) {
            return $this;
        }

        $new = clone $this;
        $new->query = $query;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        return $new;
    }

<<<<<<< HEAD
    public function withFragment($fragment)
=======
    public function withFragment($fragment): UriInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $fragment = $this->filterQueryAndFragment($fragment);

        if ($this->fragment === $fragment) {
            return $this;
        }

        $new = clone $this;
        $new->fragment = $fragment;
<<<<<<< HEAD
=======
        $new->composedComponents = null;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        return $new;
    }

    /**
     * Apply parse_url parts to a URI.
     *
     * @param array $parts Array of parse_url parts to apply.
     */
<<<<<<< HEAD
    private function applyParts(array $parts)
=======
    private function applyParts(array $parts): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->scheme = isset($parts['scheme'])
            ? $this->filterScheme($parts['scheme'])
            : '';
        $this->userInfo = isset($parts['user'])
            ? $this->filterUserInfoComponent($parts['user'])
            : '';
        $this->host = isset($parts['host'])
            ? $this->filterHost($parts['host'])
            : '';
        $this->port = isset($parts['port'])
            ? $this->filterPort($parts['port'])
            : null;
        $this->path = isset($parts['path'])
            ? $this->filterPath($parts['path'])
            : '';
        $this->query = isset($parts['query'])
            ? $this->filterQueryAndFragment($parts['query'])
            : '';
        $this->fragment = isset($parts['fragment'])
            ? $this->filterQueryAndFragment($parts['fragment'])
            : '';
        if (isset($parts['pass'])) {
            $this->userInfo .= ':' . $this->filterUserInfoComponent($parts['pass']);
        }

        $this->removeDefaultPort();
    }

    /**
<<<<<<< HEAD
     * @param string $scheme
     *
     * @return string
     *
     * @throws \InvalidArgumentException If the scheme is invalid.
     */
    private function filterScheme($scheme)
=======
     * @param mixed $scheme
     *
     * @throws \InvalidArgumentException If the scheme is invalid.
     */
    private function filterScheme($scheme): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($scheme)) {
            throw new \InvalidArgumentException('Scheme must be a string');
        }

        return \strtr($scheme, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');
    }

    /**
<<<<<<< HEAD
     * @param string $component
     *
     * @return string
     *
     * @throws \InvalidArgumentException If the user info is invalid.
     */
    private function filterUserInfoComponent($component)
=======
     * @param mixed $component
     *
     * @throws \InvalidArgumentException If the user info is invalid.
     */
    private function filterUserInfoComponent($component): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($component)) {
            throw new \InvalidArgumentException('User info must be a string');
        }

        return preg_replace_callback(
<<<<<<< HEAD
            '/(?:[^%' . self::$charUnreserved . self::$charSubDelims . ']+|%(?![A-Fa-f0-9]{2}))/',
=======
            '/(?:[^%' . self::CHAR_UNRESERVED . self::CHAR_SUB_DELIMS . ']+|%(?![A-Fa-f0-9]{2}))/',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            [$this, 'rawurlencodeMatchZero'],
            $component
        );
    }

    /**
<<<<<<< HEAD
     * @param string $host
     *
     * @return string
     *
     * @throws \InvalidArgumentException If the host is invalid.
     */
    private function filterHost($host)
=======
     * @param mixed $host
     *
     * @throws \InvalidArgumentException If the host is invalid.
     */
    private function filterHost($host): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($host)) {
            throw new \InvalidArgumentException('Host must be a string');
        }

        return \strtr($host, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');
    }

    /**
<<<<<<< HEAD
     * @param int|null $port
     *
     * @return int|null
     *
     * @throws \InvalidArgumentException If the port is invalid.
     */
    private function filterPort($port)
=======
     * @param mixed $port
     *
     * @throws \InvalidArgumentException If the port is invalid.
     */
    private function filterPort($port): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($port === null) {
            return null;
        }

        $port = (int) $port;
        if (0 > $port || 0xffff < $port) {
            throw new \InvalidArgumentException(
                sprintf('Invalid port: %d. Must be between 0 and 65535', $port)
            );
        }

        return $port;
    }

    /**
<<<<<<< HEAD
     * @param UriInterface $uri
     * @param array        $keys
     *
     * @return array
     */
    private static function getFilteredQueryString(UriInterface $uri, array $keys)
=======
     * @param string[] $keys
     *
     * @return string[]
     */
    private static function getFilteredQueryString(UriInterface $uri, array $keys): array
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $current = $uri->getQuery();

        if ($current === '') {
            return [];
        }

        $decodedKeys = array_map('rawurldecode', $keys);

        return array_filter(explode('&', $current), function ($part) use ($decodedKeys) {
            return !in_array(rawurldecode(explode('=', $part)[0]), $decodedKeys, true);
        });
    }

<<<<<<< HEAD
    /**
     * @param string      $key
     * @param string|null $value
     *
     * @return string
     */
    private static function generateQueryString($key, $value)
=======
    private static function generateQueryString(string $key, ?string $value): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        // Query string separators ("=", "&") within the key or value need to be encoded
        // (while preventing double-encoding) before setting the query string. All other
        // chars that need percent-encoding will be encoded by withQuery().
<<<<<<< HEAD
        $queryString = strtr($key, self::$replaceQuery);

        if ($value !== null) {
            $queryString .= '=' . strtr($value, self::$replaceQuery);
=======
        $queryString = strtr($key, self::QUERY_SEPARATORS_REPLACEMENT);

        if ($value !== null) {
            $queryString .= '=' . strtr($value, self::QUERY_SEPARATORS_REPLACEMENT);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }

        return $queryString;
    }

<<<<<<< HEAD
    private function removeDefaultPort()
=======
    private function removeDefaultPort(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($this->port !== null && self::isDefaultPort($this)) {
            $this->port = null;
        }
    }

    /**
     * Filters the path of a URI
     *
<<<<<<< HEAD
     * @param string $path
     *
     * @return string
     *
     * @throws \InvalidArgumentException If the path is invalid.
     */
    private function filterPath($path)
=======
     * @param mixed $path
     *
     * @throws \InvalidArgumentException If the path is invalid.
     */
    private function filterPath($path): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($path)) {
            throw new \InvalidArgumentException('Path must be a string');
        }

        return preg_replace_callback(
<<<<<<< HEAD
            '/(?:[^' . self::$charUnreserved . self::$charSubDelims . '%:@\/]++|%(?![A-Fa-f0-9]{2}))/',
=======
            '/(?:[^' . self::CHAR_UNRESERVED . self::CHAR_SUB_DELIMS . '%:@\/]++|%(?![A-Fa-f0-9]{2}))/',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            [$this, 'rawurlencodeMatchZero'],
            $path
        );
    }

    /**
     * Filters the query string or fragment of a URI.
     *
<<<<<<< HEAD
     * @param string $str
     *
     * @return string
     *
     * @throws \InvalidArgumentException If the query or fragment is invalid.
     */
    private function filterQueryAndFragment($str)
=======
     * @param mixed $str
     *
     * @throws \InvalidArgumentException If the query or fragment is invalid.
     */
    private function filterQueryAndFragment($str): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!is_string($str)) {
            throw new \InvalidArgumentException('Query and fragment must be a string');
        }

        return preg_replace_callback(
<<<<<<< HEAD
            '/(?:[^' . self::$charUnreserved . self::$charSubDelims . '%:@\/\?]++|%(?![A-Fa-f0-9]{2}))/',
=======
            '/(?:[^' . self::CHAR_UNRESERVED . self::CHAR_SUB_DELIMS . '%:@\/\?]++|%(?![A-Fa-f0-9]{2}))/',
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            [$this, 'rawurlencodeMatchZero'],
            $str
        );
    }

<<<<<<< HEAD
    private function rawurlencodeMatchZero(array $match)
=======
    private function rawurlencodeMatchZero(array $match): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return rawurlencode($match[0]);
    }

<<<<<<< HEAD
    private function validateState()
=======
    private function validateState(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($this->host === '' && ($this->scheme === 'http' || $this->scheme === 'https')) {
            $this->host = self::HTTP_DEFAULT_HOST;
        }

        if ($this->getAuthority() === '') {
            if (0 === strpos($this->path, '//')) {
                throw new \InvalidArgumentException('The path of a URI without an authority must not start with two slashes "//"');
            }
            if ($this->scheme === '' && false !== strpos(explode('/', $this->path, 2)[0], ':')) {
                throw new \InvalidArgumentException('A relative URI must not have a path beginning with a segment containing a colon');
            }
        } elseif (isset($this->path[0]) && $this->path[0] !== '/') {
<<<<<<< HEAD
            @trigger_error(
                'The path of a URI with an authority must start with a slash "/" or be empty. Automagically fixing the URI ' .
                'by adding a leading slash to the path is deprecated since version 1.4 and will throw an exception instead.',
                E_USER_DEPRECATED
            );
            $this->path = '/' . $this->path;
            //throw new \InvalidArgumentException('The path of a URI with an authority must start with a slash "/" or be empty');
=======
            throw new \InvalidArgumentException('The path of a URI with an authority must start with a slash "/" or be empty');
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }
    }
}
