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

use RuntimeException;
use Monolog\Logger;

/**
 * Handler send logs to Telegram using Telegram Bot API.
 *
 * How to use:
 *  1) Create telegram bot with https://telegram.me/BotFather
 *  2) Create a telegram channel where logs will be recorded.
 *  3) Add created bot from step 1 to the created channel from step 2.
 *
 * Use telegram bot API key from step 1 and channel name with '@' prefix from step 2 to create instance of TelegramBotHandler
 *
 * @link https://core.telegram.org/bots/api
 *
 * @author Mazur Alexandr <alexandrmazur96@gmail.com>
<<<<<<< HEAD
=======
 *
 * @phpstan-import-type Record from \Monolog\Logger
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
 */
class TelegramBotHandler extends AbstractProcessingHandler
{
    private const BOT_API = 'https://api.telegram.org/bot';

    /**
<<<<<<< HEAD
     * @var array AVAILABLE_PARSE_MODES The available values of parseMode according to the Telegram api documentation
=======
     * The available values of parseMode according to the Telegram api documentation
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private const AVAILABLE_PARSE_MODES = [
        'HTML',
        'MarkdownV2',
<<<<<<< HEAD
        'Markdown' // legacy mode without underline and strikethrough, use MarkdownV2 instead
=======
        'Markdown', // legacy mode without underline and strikethrough, use MarkdownV2 instead
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    ];

    /**
     * Telegram bot access token provided by BotFather.
     * Create telegram bot with https://telegram.me/BotFather and use access token from it.
     * @var string
     */
    private $apiKey;

    /**
     * Telegram channel name.
     * Since to start with '@' symbol as prefix.
     * @var string
     */
    private $channel;

    /**
     * The kind of formatting that is used for the message.
     * See available options at https://core.telegram.org/bots/api#formatting-options
     * or in AVAILABLE_PARSE_MODES
<<<<<<< HEAD
     * @var string|null
=======
     * @var ?string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private $parseMode;

    /**
     * Disables link previews for links in the message.
<<<<<<< HEAD
     * @var bool|null
=======
     * @var ?bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private $disableWebPagePreview;

    /**
     * Sends the message silently. Users will receive a notification with no sound.
<<<<<<< HEAD
     * @var bool|null
=======
     * @var ?bool
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    private $disableNotification;

    /**
     * @param string $apiKey  Telegram bot access token provided by BotFather
     * @param string $channel Telegram channel name
<<<<<<< HEAD
     * @inheritDoc
=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function __construct(
        string $apiKey,
        string $channel,
        $level = Logger::DEBUG,
        bool $bubble = true,
        string $parseMode = null,
        bool $disableWebPagePreview = null,
        bool $disableNotification = null
    ) {
        parent::__construct($level, $bubble);

        $this->apiKey = $apiKey;
        $this->channel = $channel;
        $this->setParseMode($parseMode);
        $this->disableWebPagePreview($disableWebPagePreview);
        $this->disableNotification($disableNotification);
    }

    public function setParseMode(string $parseMode = null): self
    {
        if ($parseMode !== null && !in_array($parseMode, self::AVAILABLE_PARSE_MODES)) {
            throw new \InvalidArgumentException('Unknown parseMode, use one of these: ' . implode(', ', self::AVAILABLE_PARSE_MODES) . '.');
        }

        $this->parseMode = $parseMode;
<<<<<<< HEAD
=======

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        return $this;
    }

    public function disableWebPagePreview(bool $disableWebPagePreview = null): self
    {
        $this->disableWebPagePreview = $disableWebPagePreview;
<<<<<<< HEAD
=======

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        return $this;
    }

    public function disableNotification(bool $disableNotification = null): self
    {
        $this->disableNotification = $disableNotification;
<<<<<<< HEAD
=======

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records): void
    {
<<<<<<< HEAD
=======
        /** @var Record[] $messages */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $messages = [];

        foreach ($records as $record) {
            if (!$this->isHandling($record)) {
                continue;
            }

            if ($this->processors) {
<<<<<<< HEAD
=======
                /** @var Record $record */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
                $record = $this->processRecord($record);
            }

            $messages[] = $record;
        }

        if (!empty($messages)) {
            $this->send((string) $this->getFormatter()->formatBatch($messages));
        }
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        $this->send($record['formatted']);
    }

    /**
     * Send request to @link https://api.telegram.org/bot on SendMessage action.
     * @param string $message
     */
    protected function send(string $message): void
    {
        $ch = curl_init();
        $url = self::BOT_API . $this->apiKey . '/SendMessage';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'text' => $message,
            'chat_id' => $this->channel,
            'parse_mode' => $this->parseMode,
            'disable_web_page_preview' => $this->disableWebPagePreview,
            'disable_notification' => $this->disableNotification,
        ]));

        $result = Curl\Util::execute($ch);
<<<<<<< HEAD
=======
        if (!is_string($result)) {
            throw new RuntimeException('Telegram API error. Description: No response');
        }
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        $result = json_decode($result, true);

        if ($result['ok'] === false) {
            throw new RuntimeException('Telegram API error. Description: ' . $result['description']);
        }
    }
}
