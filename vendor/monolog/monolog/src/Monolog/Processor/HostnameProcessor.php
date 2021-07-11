<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Processor;

/**
 * Injects value of gethostname in all records
 */
class HostnameProcessor implements ProcessorInterface
{
<<<<<<< HEAD
=======
    /** @var string */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private static $host;

    public function __construct()
    {
        self::$host = (string) gethostname();
    }

<<<<<<< HEAD
=======
    /**
     * {@inheritDoc}
     */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function __invoke(array $record): array
    {
        $record['extra']['hostname'] = self::$host;

        return $record;
    }
}
