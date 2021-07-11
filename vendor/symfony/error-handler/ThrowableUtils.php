<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ErrorHandler;

<<<<<<< HEAD
=======
use Symfony\Component\ErrorHandler\Exception\SilencedErrorContext;

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
/**
 * @internal
 */
class ThrowableUtils
{
<<<<<<< HEAD
    public static function getSeverity(\Throwable $throwable): int
    {
        if ($throwable instanceof \ErrorException) {
=======
    /**
     * @param SilencedErrorContext|\Throwable
     */
    public static function getSeverity($throwable): int
    {
        if ($throwable instanceof \ErrorException || $throwable instanceof SilencedErrorContext) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            return $throwable->getSeverity();
        }

        if ($throwable instanceof \ParseError) {
            return \E_PARSE;
        }

        if ($throwable instanceof \TypeError) {
            return \E_RECOVERABLE_ERROR;
        }

        return \E_ERROR;
    }
}
