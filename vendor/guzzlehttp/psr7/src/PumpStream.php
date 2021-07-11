<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Provides a read only stream that pumps data from a PHP callable.
 *
 * When invoking the provided callable, the PumpStream will pass the amount of
 * data requested to read to the callable. The callable can choose to ignore
 * this value and return fewer or more bytes than requested. Any extra data
 * returned by the provided callable is buffered internally until drained using
 * the read() function of the PumpStream. The provided callable MUST return
 * false when there is no more data to read.
<<<<<<< HEAD
 *
 * @final
 */
class PumpStream implements StreamInterface
{
    /** @var callable */
    private $source;

    /** @var int */
=======
 */
final class PumpStream implements StreamInterface
{
    /** @var callable|null */
    private $source;

    /** @var int|null */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $size;

    /** @var int */
    private $tellPos = 0;

    /** @var array */
    private $metadata;

    /** @var BufferStream */
    private $buffer;

    /**
<<<<<<< HEAD
     * @param callable $source  Source of the stream data. The callable MAY
     *                          accept an integer argument used to control the
     *                          amount of data to return. The callable MUST
     *                          return a string when called, or false on error
     *                          or EOF.
     * @param array    $options Stream options:
     *                          - metadata: Hash of metadata to use with stream.
     *                          - size: Size of the stream, if known.
=======
     * @param callable(int): (string|null|false)  $source  Source of the stream data. The callable MAY
     *                                                     accept an integer argument used to control the
     *                                                     amount of data to return. The callable MUST
     *                                                     return a string when called, or false|null on error
     *                                                     or EOF.
     * @param array{size?: int, metadata?: array} $options Stream options:
     *                                                     - metadata: Hash of metadata to use with stream.
     *                                                     - size: Size of the stream, if known.
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function __construct(callable $source, array $options = [])
    {
        $this->source = $source;
<<<<<<< HEAD
        $this->size = isset($options['size']) ? $options['size'] : null;
        $this->metadata = isset($options['metadata']) ? $options['metadata'] : [];
        $this->buffer = new BufferStream();
    }

    public function __toString()
    {
        try {
            return Utils::copyToString($this);
        } catch (\Exception $e) {
=======
        $this->size = $options['size'] ?? null;
        $this->metadata = $options['metadata'] ?? [];
        $this->buffer = new BufferStream();
    }

    public function __toString(): string
    {
        try {
            return Utils::copyToString($this);
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
    public function close()
=======
    public function close(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->detach();
    }

    public function detach()
    {
<<<<<<< HEAD
        $this->tellPos = false;
=======
        $this->tellPos = 0;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $this->source = null;

        return null;
    }

<<<<<<< HEAD
    public function getSize()
=======
    public function getSize(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->size;
    }

<<<<<<< HEAD
    public function tell()
=======
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->tellPos;
    }

<<<<<<< HEAD
    public function eof()
    {
        return !$this->source;
    }

    public function isSeekable()
=======
    public function eof(): bool
    {
        return $this->source === null;
    }

    public function isSeekable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return false;
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
        throw new \RuntimeException('Cannot seek a PumpStream');
    }

<<<<<<< HEAD
    public function isWritable()
=======
    public function isWritable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return false;
    }

<<<<<<< HEAD
    public function write($string)
=======
    public function write($string): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \RuntimeException('Cannot write to a PumpStream');
    }

<<<<<<< HEAD
    public function isReadable()
=======
    public function isReadable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return true;
    }

<<<<<<< HEAD
    public function read($length)
=======
    public function read($length): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $data = $this->buffer->read($length);
        $readLen = strlen($data);
        $this->tellPos += $readLen;
        $remaining = $length - $readLen;

        if ($remaining) {
            $this->pump($remaining);
            $data .= $this->buffer->read($remaining);
            $this->tellPos += strlen($data) - $readLen;
        }

        return $data;
    }

<<<<<<< HEAD
    public function getContents()
=======
    public function getContents(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $result = '';
        while (!$this->eof()) {
            $result .= $this->read(1000000);
        }

        return $result;
    }

    public function getMetadata($key = null)
    {
        if (!$key) {
            return $this->metadata;
        }

<<<<<<< HEAD
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    private function pump($length)
=======
        return $this->metadata[$key] ?? null;
    }

    private function pump(int $length): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($this->source) {
            do {
                $data = call_user_func($this->source, $length);
                if ($data === false || $data === null) {
                    $this->source = null;
                    return;
                }
                $this->buffer->write($data);
                $length -= strlen($data);
            } while ($length > 0);
        }
    }
}
