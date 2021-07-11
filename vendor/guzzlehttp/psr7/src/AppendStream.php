<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Reads from multiple streams, one after the other.
 *
 * This is a read-only stream decorator.
<<<<<<< HEAD
 *
 * @final
 */
class AppendStream implements StreamInterface
=======
 */
final class AppendStream implements StreamInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
{
    /** @var StreamInterface[] Streams being decorated */
    private $streams = [];

<<<<<<< HEAD
    private $seekable = true;
    private $current = 0;
=======
    /** @var bool */
    private $seekable = true;

    /** @var int */
    private $current = 0;

    /** @var int */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $pos = 0;

    /**
     * @param StreamInterface[] $streams Streams to decorate. Each stream must
     *                                   be readable.
     */
    public function __construct(array $streams = [])
    {
        foreach ($streams as $stream) {
            $this->addStream($stream);
        }
    }

<<<<<<< HEAD
    public function __toString()
=======
    public function __toString(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        try {
            $this->rewind();
            return $this->getContents();
<<<<<<< HEAD
        } catch (\Exception $e) {
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

    /**
     * Add a stream to the AppendStream
     *
     * @param StreamInterface $stream Stream to append. Must be readable.
     *
     * @throws \InvalidArgumentException if the stream is not readable
     */
<<<<<<< HEAD
    public function addStream(StreamInterface $stream)
=======
    public function addStream(StreamInterface $stream): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!$stream->isReadable()) {
            throw new \InvalidArgumentException('Each stream must be readable');
        }

        // The stream is only seekable if all streams are seekable
        if (!$stream->isSeekable()) {
            $this->seekable = false;
        }

        $this->streams[] = $stream;
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
     * Closes each attached stream.
<<<<<<< HEAD
     *
     * {@inheritdoc}
     */
    public function close()
=======
     */
    public function close(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->pos = $this->current = 0;
        $this->seekable = true;

        foreach ($this->streams as $stream) {
            $stream->close();
        }

        $this->streams = [];
    }

    /**
     * Detaches each attached stream.
     *
     * Returns null as it's not clear which underlying stream resource to return.
<<<<<<< HEAD
     *
     * {@inheritdoc}
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function detach()
    {
        $this->pos = $this->current = 0;
        $this->seekable = true;

        foreach ($this->streams as $stream) {
            $stream->detach();
        }

        $this->streams = [];

        return null;
    }

<<<<<<< HEAD
    public function tell()
=======
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->pos;
    }

    /**
     * Tries to calculate the size by adding the size of each stream.
     *
     * If any of the streams do not return a valid number, then the size of the
     * append stream cannot be determined and null is returned.
<<<<<<< HEAD
     *
     * {@inheritdoc}
     */
    public function getSize()
=======
     */
    public function getSize(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $size = 0;

        foreach ($this->streams as $stream) {
            $s = $stream->getSize();
            if ($s === null) {
                return null;
            }
            $size += $s;
        }

        return $size;
    }

<<<<<<< HEAD
    public function eof()
=======
    public function eof(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return !$this->streams ||
            ($this->current >= count($this->streams) - 1 &&
             $this->streams[$this->current]->eof());
    }

<<<<<<< HEAD
    public function rewind()
=======
    public function rewind(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->seek(0);
    }

    /**
     * Attempts to seek to the given position. Only supports SEEK_SET.
<<<<<<< HEAD
     *
     * {@inheritdoc}
     */
    public function seek($offset, $whence = SEEK_SET)
=======
     */
    public function seek($offset, $whence = SEEK_SET): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        if (!$this->seekable) {
            throw new \RuntimeException('This AppendStream is not seekable');
        } elseif ($whence !== SEEK_SET) {
            throw new \RuntimeException('The AppendStream can only seek with SEEK_SET');
        }

        $this->pos = $this->current = 0;

        // Rewind each stream
        foreach ($this->streams as $i => $stream) {
            try {
                $stream->rewind();
            } catch (\Exception $e) {
                throw new \RuntimeException('Unable to seek stream '
                    . $i . ' of the AppendStream', 0, $e);
            }
        }

        // Seek to the actual position by reading from each stream
        while ($this->pos < $offset && !$this->eof()) {
            $result = $this->read(min(8096, $offset - $this->pos));
            if ($result === '') {
                break;
            }
        }
    }

    /**
     * Reads from all of the appended streams until the length is met or EOF.
<<<<<<< HEAD
     *
     * {@inheritdoc}
     */
    public function read($length)
=======
     */
    public function read($length): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $buffer = '';
        $total = count($this->streams) - 1;
        $remaining = $length;
        $progressToNext = false;

        while ($remaining > 0) {

            // Progress to the next stream if needed.
            if ($progressToNext || $this->streams[$this->current]->eof()) {
                $progressToNext = false;
                if ($this->current === $total) {
                    break;
                }
                $this->current++;
            }

            $result = $this->streams[$this->current]->read($remaining);

<<<<<<< HEAD
            // Using a loose comparison here to match on '', false, and null
            if ($result == null) {
=======
            if ($result === '') {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
                $progressToNext = true;
                continue;
            }

            $buffer .= $result;
            $remaining = $length - strlen($buffer);
        }

        $this->pos += strlen($buffer);

        return $buffer;
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
        return false;
    }

<<<<<<< HEAD
    public function isSeekable()
=======
    public function isSeekable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return $this->seekable;
    }

<<<<<<< HEAD
    public function write($string)
=======
    public function write($string): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \RuntimeException('Cannot write to an AppendStream');
    }

    public function getMetadata($key = null)
    {
        return $key ? null : [];
    }
}
