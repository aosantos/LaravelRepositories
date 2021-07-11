<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Decorator used to return only a subset of a stream.
<<<<<<< HEAD
 *
 * @final
 */
class LimitStream implements StreamInterface
=======
 */
final class LimitStream implements StreamInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
{
    use StreamDecoratorTrait;

    /** @var int Offset to start reading from */
    private $offset;

    /** @var int Limit the number of bytes that can be read */
    private $limit;

    /**
     * @param StreamInterface $stream Stream to wrap
     * @param int             $limit  Total number of bytes to allow to be read
     *                                from the stream. Pass -1 for no limit.
     * @param int             $offset Position to seek to before reading (only
     *                                works on seekable streams).
     */
    public function __construct(
        StreamInterface $stream,
<<<<<<< HEAD
        $limit = -1,
        $offset = 0
=======
        int $limit = -1,
        int $offset = 0
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    ) {
        $this->stream = $stream;
        $this->setLimit($limit);
        $this->setOffset($offset);
    }

<<<<<<< HEAD
    public function eof()
=======
    public function eof(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        // Always return true if the underlying stream is EOF
        if ($this->stream->eof()) {
            return true;
        }

        // No limit and the underlying stream is not at EOF
<<<<<<< HEAD
        if ($this->limit == -1) {
=======
        if ($this->limit === -1) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return false;
        }

        return $this->stream->tell() >= $this->offset + $this->limit;
    }

    /**
     * Returns the size of the limited subset of data
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function getSize()
    {
        if (null === ($length = $this->stream->getSize())) {
            return null;
        } elseif ($this->limit == -1) {
=======
     */
    public function getSize(): ?int
    {
        if (null === ($length = $this->stream->getSize())) {
            return null;
        } elseif ($this->limit === -1) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return $length - $this->offset;
        } else {
            return min($this->limit, $length - $this->offset);
        }
    }

    /**
     * Allow for a bounded seek on the read limited stream
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function seek($offset, $whence = SEEK_SET)
=======
     */
    public function seek($offset, $whence = SEEK_SET): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if ($whence !== SEEK_SET || $offset < 0) {
            throw new \RuntimeException(sprintf(
                'Cannot seek to offset %s with whence %s',
                $offset,
                $whence
            ));
        }

        $offset += $this->offset;

        if ($this->limit !== -1) {
            if ($offset > $this->offset + $this->limit) {
                $offset = $this->offset + $this->limit;
            }
        }

        $this->stream->seek($offset);
    }

    /**
     * Give a relative tell()
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function tell()
=======
     */
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->stream->tell() - $this->offset;
    }

    /**
     * Set the offset to start limiting from
     *
     * @param int $offset Offset to seek to and begin byte limiting from
     *
     * @throws \RuntimeException if the stream cannot be seeked.
     */
<<<<<<< HEAD
    public function setOffset($offset)
=======
    public function setOffset(int $offset): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $current = $this->stream->tell();

        if ($current !== $offset) {
            // If the stream cannot seek to the offset position, then read to it
            if ($this->stream->isSeekable()) {
                $this->stream->seek($offset);
            } elseif ($current > $offset) {
                throw new \RuntimeException("Could not seek to stream offset $offset");
            } else {
                $this->stream->read($offset - $current);
            }
        }

        $this->offset = $offset;
    }

    /**
     * Set the limit of bytes that the decorator allows to be read from the
     * stream.
     *
     * @param int $limit Number of bytes to allow to be read from the stream.
     *                   Use -1 for no limit.
     */
<<<<<<< HEAD
    public function setLimit($limit)
=======
    public function setLimit(int $limit): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->limit = $limit;
    }

<<<<<<< HEAD
    public function read($length)
    {
        if ($this->limit == -1) {
=======
    public function read($length): string
    {
        if ($this->limit === -1) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return $this->stream->read($length);
        }

        // Check if the current position is less than the total allowed
        // bytes + original offset
        $remaining = ($this->offset + $this->limit) - $this->stream->tell();
        if ($remaining > 0) {
            // Only return the amount of requested data, ensuring that the byte
            // limit is not exceeded
            return $this->stream->read(min($remaining, $length));
        }

        return '';
    }
}
