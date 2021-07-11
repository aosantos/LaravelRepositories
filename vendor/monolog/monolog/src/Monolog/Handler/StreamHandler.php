<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Logger;
use Monolog\Utils;

/**
 * Stores to any stream resource
 *
 * Can be used to store into php://stderr, remote and local files, etc.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
<<<<<<< HEAD
 */
class StreamHandler extends AbstractProcessingHandler
{
    /** @var resource|null */
    protected $stream;
    protected $url;
    /** @var string|null */
    private $errorMessage;
    protected $filePermission;
    protected $useLocking;
    private $dirCreated;

    /**
     * @param resource|string $stream         If a missing path can't be created, an UnexpectedValueException will be thrown on first write
     * @param string|int      $level          The minimum logging level at which this handler will be triggered
     * @param bool            $bubble         Whether the messages that are handled can bubble up the stack or not
=======
 *
 * @phpstan-import-type FormattedRecord from AbstractProcessingHandler
 */
class StreamHandler extends AbstractProcessingHandler
{
    protected const MAX_CHUNK_SIZE = 2147483647;

    /** @var resource|null */
    protected $stream;
    /** @var ?string */
    protected $url = null;
    /** @var ?string */
    private $errorMessage = null;
    /** @var ?int */
    protected $filePermission;
    /** @var bool */
    protected $useLocking;
    /** @var true|null */
    private $dirCreated = null;

    /**
     * @param resource|string $stream         If a missing path can't be created, an UnexpectedValueException will be thrown on first write
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @param int|null        $filePermission Optional file permissions (default (0644) are only for owner read/write)
     * @param bool            $useLocking     Try to lock log file before doing any writes
     *
     * @throws \InvalidArgumentException If stream is not a resource or string
     */
    public function __construct($stream, $level = Logger::DEBUG, bool $bubble = true, ?int $filePermission = null, bool $useLocking = false)
    {
        parent::__construct($level, $bubble);
        if (is_resource($stream)) {
            $this->stream = $stream;
<<<<<<< HEAD
=======
            stream_set_chunk_size($this->stream, self::MAX_CHUNK_SIZE);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        } elseif (is_string($stream)) {
            $this->url = Utils::canonicalizePath($stream);
        } else {
            throw new \InvalidArgumentException('A stream must either be a resource or a string.');
        }

        $this->filePermission = $filePermission;
        $this->useLocking = $useLocking;
    }

    /**
     * {@inheritdoc}
     */
    public function close(): void
    {
        if ($this->url && is_resource($this->stream)) {
            fclose($this->stream);
        }
        $this->stream = null;
        $this->dirCreated = null;
    }

    /**
     * Return the currently active stream if it is open
     *
     * @return resource|null
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Return the stream URL if it was configured with a URL and not an active resource
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        if (!is_resource($this->stream)) {
<<<<<<< HEAD
            if (null === $this->url || '' === $this->url) {
                throw new \LogicException('Missing stream url, the stream can not be opened. This may be caused by a premature call to close().');
            }
            $this->createDir();
            $this->errorMessage = null;
            set_error_handler([$this, 'customErrorHandler']);
            $this->stream = fopen($this->url, 'a');
            if ($this->filePermission !== null) {
                @chmod($this->url, $this->filePermission);
            }
            restore_error_handler();
            if (!is_resource($this->stream)) {
                $this->stream = null;

                throw new \UnexpectedValueException(sprintf('The stream or file "%s" could not be opened in append mode: '.$this->errorMessage, $this->url));
            }
=======
            $url = $this->url;
            if (null === $url || '' === $url) {
                throw new \LogicException('Missing stream url, the stream can not be opened. This may be caused by a premature call to close().');
            }
            $this->createDir($url);
            $this->errorMessage = null;
            set_error_handler([$this, 'customErrorHandler']);
            $stream = fopen($url, 'a');
            if ($this->filePermission !== null) {
                @chmod($url, $this->filePermission);
            }
            restore_error_handler();
            if (!is_resource($stream)) {
                $this->stream = null;

                throw new \UnexpectedValueException(sprintf('The stream or file "%s" could not be opened in append mode: '.$this->errorMessage, $url));
            }
            stream_set_chunk_size($stream, self::MAX_CHUNK_SIZE);
            $this->stream = $stream;
        }

        $stream = $this->stream;
        if (!is_resource($stream)) {
            throw new \LogicException('No stream was opened yet');
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }

        if ($this->useLocking) {
            // ignoring errors here, there's not much we can do about them
<<<<<<< HEAD
            flock($this->stream, LOCK_EX);
        }

        $this->streamWrite($this->stream, $record);

        if ($this->useLocking) {
            flock($this->stream, LOCK_UN);
=======
            flock($stream, LOCK_EX);
        }

        $this->streamWrite($stream, $record);

        if ($this->useLocking) {
            flock($stream, LOCK_UN);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        }
    }

    /**
     * Write to stream
     * @param resource $stream
     * @param array    $record
<<<<<<< HEAD
=======
     *
     * @phpstan-param FormattedRecord $record
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    protected function streamWrite($stream, array $record): void
    {
        fwrite($stream, (string) $record['formatted']);
    }

<<<<<<< HEAD
    private function customErrorHandler($code, $msg): bool
=======
    private function customErrorHandler(int $code, string $msg): bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        $this->errorMessage = preg_replace('{^(fopen|mkdir)\(.*?\): }', '', $msg);

        return true;
    }

    private function getDirFromStream(string $stream): ?string
    {
        $pos = strpos($stream, '://');
        if ($pos === false) {
            return dirname($stream);
        }

        if ('file://' === substr($stream, 0, 7)) {
            return dirname(substr($stream, 7));
        }

        return null;
    }

<<<<<<< HEAD
    private function createDir(): void
=======
    private function createDir(string $url): void
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    {
        // Do not try to create dir if it has already been tried.
        if ($this->dirCreated) {
            return;
        }

<<<<<<< HEAD
        $dir = $this->getDirFromStream($this->url);
=======
        $dir = $this->getDirFromStream($url);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        if (null !== $dir && !is_dir($dir)) {
            $this->errorMessage = null;
            set_error_handler([$this, 'customErrorHandler']);
            $status = mkdir($dir, 0777, true);
            restore_error_handler();
            if (false === $status && !is_dir($dir)) {
                throw new \UnexpectedValueException(sprintf('There is no existing directory at "%s" and it could not be created: '.$this->errorMessage, $dir));
            }
        }
        $this->dirCreated = true;
    }
}
