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
 * Adds value of getmypid into records
 *
 * @author Andreas Hörnicke
 */
class ProcessIdProcessor implements ProcessorInterface
{
<<<<<<< HEAD
=======
    /**
     * {@inheritDoc}
     */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function __invoke(array $record): array
    {
        $record['extra']['process_id'] = getmypid();

        return $record;
    }
}
