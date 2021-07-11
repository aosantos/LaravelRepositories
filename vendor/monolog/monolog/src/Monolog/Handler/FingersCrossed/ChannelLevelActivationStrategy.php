<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler\FingersCrossed;

use Monolog\Logger;
<<<<<<< HEAD
=======
use Psr\Log\LogLevel;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

/**
 * Channel and Error level based monolog activation strategy. Allows to trigger activation
 * based on level per channel. e.g. trigger activation on level 'ERROR' by default, except
 * for records of the 'sql' channel; those should trigger activation on level 'WARN'.
 *
 * Example:
 *
 * <code>
 *   $activationStrategy = new ChannelLevelActivationStrategy(
 *       Logger::CRITICAL,
 *       array(
 *           'request' => Logger::ALERT,
 *           'sensitive' => Logger::ERROR,
 *       )
 *   );
 *   $handler = new FingersCrossedHandler(new StreamHandler('php://stderr'), $activationStrategy);
 * </code>
 *
 * @author Mike Meessen <netmikey@gmail.com>
<<<<<<< HEAD
=======
 *
 * @phpstan-import-type Record from \Monolog\Logger
 * @phpstan-import-type Level from \Monolog\Logger
 * @phpstan-import-type LevelName from \Monolog\Logger
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
 */
class ChannelLevelActivationStrategy implements ActivationStrategyInterface
{
    /**
<<<<<<< HEAD
     * @var int
=======
     * @var Level
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private $defaultActionLevel;

    /**
<<<<<<< HEAD
     * @var array
=======
     * @var array<string, Level>
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private $channelToActionLevel;

    /**
<<<<<<< HEAD
     * @param int|string $defaultActionLevel   The default action level to be used if the record's category doesn't match any
     * @param array      $channelToActionLevel An array that maps channel names to action levels.
=======
     * @param int|string         $defaultActionLevel   The default action level to be used if the record's category doesn't match any
     * @param array<string, int> $channelToActionLevel An array that maps channel names to action levels.
     *
     * @phpstan-param array<string, Level>        $channelToActionLevel
     * @phpstan-param Level|LevelName|LogLevel::* $defaultActionLevel
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function __construct($defaultActionLevel, array $channelToActionLevel = [])
    {
        $this->defaultActionLevel = Logger::toMonologLevel($defaultActionLevel);
        $this->channelToActionLevel = array_map('Monolog\Logger::toMonologLevel', $channelToActionLevel);
    }

<<<<<<< HEAD
=======
    /**
     * @phpstan-param Record $record
     */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function isHandlerActivated(array $record): bool
    {
        if (isset($this->channelToActionLevel[$record['channel']])) {
            return $record['level'] >= $this->channelToActionLevel[$record['channel']];
        }

        return $record['level'] >= $this->defaultActionLevel;
    }
}
