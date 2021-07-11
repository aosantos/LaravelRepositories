<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Compose stream implementations based on a hash of functions.
 *
 * Allows for easy testing and extension of a provided stream without needing
 * to create a concrete class for a simple extension point.
<<<<<<< HEAD
 *
 * @final
 */
class FnStream implements StreamInterface
{
    /** @var array */
    private $methods;

    /** @var array Methods that must be implemented in the given array */
    private static $slots = ['__toString', 'close', 'detach', 'rewind',
        'getSize', 'tell', 'eof', 'isSeekable', 'seek', 'isWritable', 'write',
        'isReadable', 'read', 'getContents', 'getMetadata'];

    /**
     * @param array $methods Hash of method name to a callable.
=======
 */
final class FnStream implements StreamInterface
{
    private const SLOTS = [
        '__toString', 'close', 'detach', 'rewind',
        'getSize', 'tell', 'eof', 'isSeekable', 'seek', 'isWritable', 'write',
        'isReadable', 'read', 'getContents', 'getMetadata'
    ];

    /** @var array<string, callable> */
    private $methods;

    /**
     * @param array<string, callable> $methods Hash of method name to a callable.
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function __construct(array $methods)
    {
        $this->methods = $methods;

        // Create the functions on the class
        foreach ($methods as $name => $fn) {
            $this->{'_fn_' . $name} = $fn;
        }
    }

    /**
     * Lazily determine which methods are not implemented.
     *
     * @throws \BadMethodCallException
     */
<<<<<<< HEAD
    public function __get($name)
=======
    public function __get(string $name): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \BadMethodCallException(str_replace('_fn_', '', $name)
            . '() is not implemented in the FnStream');
    }

    /**
     * The close method is called on the underlying stream only if possible.
     */
    public function __destruct()
    {
        if (isset($this->_fn_close)) {
            call_user_func($this->_fn_close);
        }
    }

    /**
     * An unserialize would allow the __destruct to run when the unserialized value goes out of scope.
     *
     * @throws \LogicException
     */
<<<<<<< HEAD
    public function __wakeup()
=======
    public function __wakeup(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        throw new \LogicException('FnStream should never be unserialized');
    }

    /**
     * Adds custom functionality to an underlying stream by intercepting
     * specific method calls.
     *
<<<<<<< HEAD
     * @param StreamInterface $stream  Stream to decorate
     * @param array           $methods Hash of method name to a closure
=======
     * @param StreamInterface         $stream  Stream to decorate
     * @param array<string, callable> $methods Hash of method name to a closure
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     *
     * @return FnStream
     */
    public static function decorate(StreamInterface $stream, array $methods)
    {
        // If any of the required methods were not provided, then simply
        // proxy to the decorated stream.
<<<<<<< HEAD
        foreach (array_diff(self::$slots, array_keys($methods)) as $diff) {
            $methods[$diff] = [$stream, $diff];
=======
        foreach (array_diff(self::SLOTS, array_keys($methods)) as $diff) {
            /** @var callable $callable */
            $callable = [$stream, $diff];
            $methods[$diff] = $callable;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }

        return new self($methods);
    }

<<<<<<< HEAD
    public function __toString()
    {
        return call_user_func($this->_fn___toString);
    }

    public function close()
    {
        return call_user_func($this->_fn_close);
=======
    public function __toString(): string
    {
        try {
            return call_user_func($this->_fn___toString);
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            trigger_error(sprintf('%s::__toString exception: %s', self::class, (string) $e), E_USER_ERROR);
            return '';
        }
    }

    public function close(): void
    {
        call_user_func($this->_fn_close);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    }

    public function detach()
    {
        return call_user_func($this->_fn_detach);
    }

<<<<<<< HEAD
    public function getSize()
=======
    public function getSize(): ?int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_getSize);
    }

<<<<<<< HEAD
    public function tell()
=======
    public function tell(): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_tell);
    }

<<<<<<< HEAD
    public function eof()
=======
    public function eof(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_eof);
    }

<<<<<<< HEAD
    public function isSeekable()
=======
    public function isSeekable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_isSeekable);
    }

<<<<<<< HEAD
    public function rewind()
=======
    public function rewind(): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        call_user_func($this->_fn_rewind);
    }

<<<<<<< HEAD
    public function seek($offset, $whence = SEEK_SET)
=======
    public function seek($offset, $whence = SEEK_SET): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        call_user_func($this->_fn_seek, $offset, $whence);
    }

<<<<<<< HEAD
    public function isWritable()
=======
    public function isWritable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_isWritable);
    }

<<<<<<< HEAD
    public function write($string)
=======
    public function write($string): int
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_write, $string);
    }

<<<<<<< HEAD
    public function isReadable()
=======
    public function isReadable(): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_isReadable);
    }

<<<<<<< HEAD
    public function read($length)
=======
    public function read($length): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_read, $length);
    }

<<<<<<< HEAD
    public function getContents()
=======
    public function getContents(): string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        return call_user_func($this->_fn_getContents);
    }

    public function getMetadata($key = null)
    {
        return call_user_func($this->_fn_getMetadata, $key);
    }
}
