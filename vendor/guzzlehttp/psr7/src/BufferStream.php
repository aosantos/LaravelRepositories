<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Provides a buffer stream that can be written to to fill a buffer, and read
 * from to remove bytes from the buffer.
 *
 * This stream returns a "hwm" metadata value that tells upstream consumers
 * what the configured high water mark of the stream is, or the maximum
 * preferred size of the buffer.
<<<<<<< HEAD
 *
 * @final
 */
class BufferStream implements StreamInterface
{
    private $hwm;
=======
 */
final class BufferStream implements StreamInterface
{
    /** @var int */
    private $hwm;

    /** @var string */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $buffer = '';

    /**
     * @param int $hwm High water mark, representing the preferred maximum
     *                 buffer size. If the size of the buffer exceeds the high
     *                 water mark, then calls to write will continue to succeed
<<<<<<< HEAD
     *                 but will return false to inform writers to slow down
     *                 until the buffer has been drained by reading from it.
     */
    public function __construct($hwm = 16384)
=======
     *                 but will return 0 to inform writers to slow down
     *                 until the buffer has been drained by reading from it.
     */
    public function __construct(int $hwm = 16384)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->hwm = $hwm;
    }

<<<<<<< HEAD
    public function __toString()
=======
    public function __toString(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->getContents();
    }

<<<<<<< HEAD
    public function getContents()
=======
    public function getContents(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $buffer = $this->buffer;
        $this->buffer = '';

        return $buffer;
    }

<<<<<<< HEAD
    public function close()
=======
    public function close(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->buffer = '';
    }

    public function detach()
    {
        $this->close();

        return null;
    }

<<<<<<< HEAD
    public function getSize()
=======
    public function getSize(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return strlen($this->buffer);
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
    public function isWritable()
=======
    public function isWritable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return true;
    }

<<<<<<< HEAD
    public function isSeekable()
=======
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
        throw new \RuntimeException('Cannot seek a BufferStream');
    }

<<<<<<< HEAD
    public function eof()
=======
    public function eof(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return strlen($this->buffer) === 0;
    }

<<<<<<< HEAD
    public function tell()
=======
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \RuntimeException('Cannot determine the position of a BufferStream');
    }

    /**
     * Reads data from the buffer.
     */
<<<<<<< HEAD
    public function read($length)
=======
    public function read($length): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $currentLength = strlen($this->buffer);

        if ($length >= $currentLength) {
            // No need to slice the buffer because we don't have enough data.
            $result = $this->buffer;
            $this->buffer = '';
        } else {
            // Slice up the result to provide a subset of the buffer.
            $result = substr($this->buffer, 0, $length);
            $this->buffer = substr($this->buffer, $length);
        }

        return $result;
    }

    /**
     * Writes data to the buffer.
     */
<<<<<<< HEAD
    public function write($string)
    {
        $this->buffer .= $string;

        // TODO: What should happen here?
        if (strlen($this->buffer) >= $this->hwm) {
            return false;
=======
    public function write($string): int
    {
        $this->buffer .= $string;

        if (strlen($this->buffer) >= $this->hwm) {
            return 0;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }

        return strlen($string);
    }

    public function getMetadata($key = null)
    {
<<<<<<< HEAD
        if ($key == 'hwm') {
=======
        if ($key === 'hwm') {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return $this->hwm;
        }

        return $key ? null : [];
    }
}
