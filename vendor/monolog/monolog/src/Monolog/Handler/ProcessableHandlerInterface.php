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

use Monolog\Processor\ProcessorInterface;

/**
 * Interface to describe loggers that have processors
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
<<<<<<< HEAD
=======
 *
 * @phpstan-import-type Record from \Monolog\Logger
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
 */
interface ProcessableHandlerInterface
{
    /**
     * Adds a processor in the stack.
     *
<<<<<<< HEAD
     * @psalm-param ProcessorInterface|callable(array): array $callback
=======
     * @psalm-param ProcessorInterface|callable(Record): Record $callback
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     *
     * @param  ProcessorInterface|callable $callback
     * @return HandlerInterface            self
     */
    public function pushProcessor(callable $callback): HandlerInterface;

    /**
     * Removes the processor on top of the stack and returns it.
     *
<<<<<<< HEAD
     * @psalm-return callable(array): array
     *
     * @throws \LogicException In case the processor stack is empty
     * @return callable
=======
     * @psalm-return ProcessorInterface|callable(Record): Record $callback
     *
     * @throws \LogicException             In case the processor stack is empty
     * @return callable|ProcessorInterface
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function popProcessor(): callable;
}
