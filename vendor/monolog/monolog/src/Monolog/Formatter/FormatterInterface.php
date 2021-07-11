<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Formatter;

/**
 * Interface for formatters
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
<<<<<<< HEAD
=======
 *
 * @phpstan-import-type Record from \Monolog\Logger
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
 */
interface FormatterInterface
{
    /**
     * Formats a log record.
     *
     * @param  array $record A record to format
     * @return mixed The formatted record
<<<<<<< HEAD
=======
     *
     * @phpstan-param Record $record
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function format(array $record);

    /**
     * Formats a set of log records.
     *
     * @param  array $records A set of records to format
     * @return mixed The formatted set of records
<<<<<<< HEAD
=======
     *
     * @phpstan-param Record[] $records
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function formatBatch(array $records);
}
