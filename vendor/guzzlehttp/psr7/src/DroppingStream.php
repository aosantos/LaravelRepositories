<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Stream decorator that begins dropping data once the size of the underlying
 * stream becomes too full.
<<<<<<< HEAD
 *
 * @final
 */
class DroppingStream implements StreamInterface
{
    use StreamDecoratorTrait;

=======
 */
final class DroppingStream implements StreamInterface
{
    use StreamDecoratorTrait;

    /** @var int */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $maxLength;

    /**
     * @param StreamInterface $stream    Underlying stream to decorate.
     * @param int             $maxLength Maximum size before dropping data.
     */
<<<<<<< HEAD
    public function __construct(StreamInterface $stream, $maxLength)
=======
    public function __construct(StreamInterface $stream, int $maxLength)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->stream = $stream;
        $this->maxLength = $maxLength;
    }

<<<<<<< HEAD
    public function write($string)
=======
    public function write($string): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $diff = $this->maxLength - $this->stream->getSize();

        // Begin returning 0 when the underlying stream is too large.
        if ($diff <= 0) {
            return 0;
        }

        // Write the stream or a subset of the stream if needed.
        if (strlen($string) < $diff) {
            return $this->stream->write($string);
        }

        return $this->stream->write(substr($string, 0, $diff));
    }
}
