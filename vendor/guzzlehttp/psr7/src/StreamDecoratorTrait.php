<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Stream decorator trait
 *
<<<<<<< HEAD
 * @property StreamInterface stream
=======
 * @property StreamInterface $stream
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
 */
trait StreamDecoratorTrait
{
    /**
     * @param StreamInterface $stream Stream to decorate
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Magic method used to create a new stream if streams are not added in
     * the constructor of a decorator (e.g., LazyOpenStream).
     *
<<<<<<< HEAD
     * @param string $name Name of the property (allows "stream" only).
     *
     * @return StreamInterface
     */
    public function __get($name)
    {
        if ($name == 'stream') {
=======
     * @return StreamInterface
     */
    public function __get(string $name)
    {
        if ($name === 'stream') {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            $this->stream = $this->createStream();
            return $this->stream;
        }

        throw new \UnexpectedValueException("$name not found on class");
    }

<<<<<<< HEAD
    public function __toString()
=======
    public function __toString(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        try {
            if ($this->isSeekable()) {
                $this->seek(0);
            }
            return $this->getContents();
<<<<<<< HEAD
        } catch (\Exception $e) {
            // Really, PHP? https://bugs.php.net/bug.php?id=53648
            trigger_error('StreamDecorator::__toString exception: '
                . (string) $e, E_USER_ERROR);
=======
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            trigger_error(sprintf('%s::__toString exception: %s', self::class, (string) $e), E_USER_ERROR);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return '';
        }
    }

<<<<<<< HEAD
    public function getContents()
=======
    public function getContents(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return Utils::copyToString($this);
    }

    /**
     * Allow decorators to implement custom methods
     *
<<<<<<< HEAD
     * @param string $method Missing method name
     * @param array  $args   Method arguments
     *
     * @return mixed
     */
    public function __call($method, array $args)
    {
        $result = call_user_func_array([$this->stream, $method], $args);
=======
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        /** @var callable $callable */
        $callable = [$this->stream, $method];
        $result = call_user_func_array($callable, $args);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        // Always return the wrapped object if the result is a return $this
        return $result === $this->stream ? $this : $result;
    }

<<<<<<< HEAD
    public function close()
=======
    public function close(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->stream->close();
    }

    public function getMetadata($key = null)
    {
        return $this->stream->getMetadata($key);
    }

    public function detach()
    {
        return $this->stream->detach();
    }

<<<<<<< HEAD
    public function getSize()
=======
    public function getSize(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->getSize();
    }

<<<<<<< HEAD
    public function eof()
=======
    public function eof(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->eof();
    }

<<<<<<< HEAD
    public function tell()
=======
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->tell();
    }

<<<<<<< HEAD
    public function isReadable()
=======
    public function isReadable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->isReadable();
    }

<<<<<<< HEAD
    public function isWritable()
=======
    public function isWritable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->isWritable();
    }

<<<<<<< HEAD
    public function isSeekable()
=======
    public function isSeekable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->isSeekable();
    }

<<<<<<< HEAD
    public function rewind()
=======
    public function rewind(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->seek(0);
    }

<<<<<<< HEAD
    public function seek($offset, $whence = SEEK_SET)
=======
    public function seek($offset, $whence = SEEK_SET): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->stream->seek($offset, $whence);
    }

<<<<<<< HEAD
    public function read($length)
=======
    public function read($length): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->read($length);
    }

<<<<<<< HEAD
    public function write($string)
=======
    public function write($string): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->write($string);
    }

    /**
     * Implement in subclasses to dynamically create streams when requested.
     *
<<<<<<< HEAD
     * @return StreamInterface
     *
     * @throws \BadMethodCallException
     */
    protected function createStream()
=======
     * @throws \BadMethodCallException
     */
    protected function createStream(): StreamInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
