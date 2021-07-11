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
 * Logs to Cube.
 *
 * @link http://square.github.com/cube/
 * @author Wan Chen <kami@kamisama.me>
 */
class CubeHandler extends AbstractProcessingHandler
{
<<<<<<< HEAD
    private $udpConnection;
    private $httpConnection;
    private $scheme;
    private $host;
    private $port;
=======
    /** @var resource|\Socket|null */
    private $udpConnection = null;
    /** @var resource|\CurlHandle|null */
    private $httpConnection = null;
    /** @var string */
    private $scheme;
    /** @var string */
    private $host;
    /** @var int */
    private $port;
    /** @var string[] */
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    private $acceptedSchemes = ['http', 'udp'];

    /**
     * Create a Cube handler
     *
     * @throws \UnexpectedValueException when given url is not a valid url.
     *                                   A valid url must consist of three parts : protocol://host:port
     *                                   Only valid protocols used by Cube are http and udp
     */
    public function __construct(string $url, $level = Logger::DEBUG, bool $bubble = true)
    {
        $urlInfo = parse_url($url);

<<<<<<< HEAD
        if (!isset($urlInfo['scheme'], $urlInfo['host'], $urlInfo['port'])) {
=======
        if ($urlInfo === false || !isset($urlInfo['scheme'], $urlInfo['host'], $urlInfo['port'])) {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            throw new \UnexpectedValueException('URL "'.$url.'" is not valid');
        }

        if (!in_array($urlInfo['scheme'], $this->acceptedSchemes)) {
            throw new \UnexpectedValueException(
                'Invalid protocol (' . $urlInfo['scheme']  . ').'
                . ' Valid options are ' . implode(', ', $this->acceptedSchemes)
            );
        }

        $this->scheme = $urlInfo['scheme'];
        $this->host = $urlInfo['host'];
<<<<<<< HEAD
        $this->port = $urlInfo['port'];
=======
        $this->port = (int) $urlInfo['port'];
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

        parent::__construct($level, $bubble);
    }

    /**
     * Establish a connection to an UDP socket
     *
     * @throws \LogicException           when unable to connect to the socket
     * @throws MissingExtensionException when there is no socket extension
     */
    protected function connectUdp(): void
    {
        if (!extension_loaded('sockets')) {
            throw new MissingExtensionException('The sockets extension is required to use udp URLs with the CubeHandler');
        }

<<<<<<< HEAD
        $this->udpConnection = socket_create(AF_INET, SOCK_DGRAM, 0);
        if (!$this->udpConnection) {
            throw new \LogicException('Unable to create a socket');
        }

=======
        $udpConnection = socket_create(AF_INET, SOCK_DGRAM, 0);
        if (false === $udpConnection) {
            throw new \LogicException('Unable to create a socket');
        }

        $this->udpConnection = $udpConnection;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        if (!socket_connect($this->udpConnection, $this->host, $this->port)) {
            throw new \LogicException('Unable to connect to the socket at ' . $this->host . ':' . $this->port);
        }
    }

    /**
     * Establish a connection to an http server
     *
     * @throws \LogicException           when unable to connect to the socket
     * @throws MissingExtensionException when no curl extension
     */
    protected function connectHttp(): void
    {
        if (!extension_loaded('curl')) {
            throw new MissingExtensionException('The curl extension is required to use http URLs with the CubeHandler');
        }

<<<<<<< HEAD
        $this->httpConnection = curl_init('http://'.$this->host.':'.$this->port.'/1.0/event/put');

        if (!$this->httpConnection) {
            throw new \LogicException('Unable to connect to ' . $this->host . ':' . $this->port);
        }

=======
        $httpConnection = curl_init('http://'.$this->host.':'.$this->port.'/1.0/event/put');
        if (false === $httpConnection) {
            throw new \LogicException('Unable to connect to ' . $this->host . ':' . $this->port);
        }

        $this->httpConnection = $httpConnection;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        curl_setopt($this->httpConnection, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->httpConnection, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        $date = $record['datetime'];

        $data = ['time' => $date->format('Y-m-d\TH:i:s.uO')];
        unset($record['datetime']);

        if (isset($record['context']['type'])) {
            $data['type'] = $record['context']['type'];
            unset($record['context']['type']);
        } else {
            $data['type'] = $record['channel'];
        }

        $data['data'] = $record['context'];
        $data['data']['level'] = $record['level'];

        if ($this->scheme === 'http') {
            $this->writeHttp(Utils::jsonEncode($data));
        } else {
            $this->writeUdp(Utils::jsonEncode($data));
        }
    }

    private function writeUdp(string $data): void
    {
        if (!$this->udpConnection) {
            $this->connectUdp();
        }

        socket_send($this->udpConnection, $data, strlen($data), 0);
    }

    private function writeHttp(string $data): void
    {
        if (!$this->httpConnection) {
            $this->connectHttp();
        }

<<<<<<< HEAD
=======
        if (null === $this->httpConnection) {
            throw new \LogicException('No connection could be established');
        }

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        curl_setopt($this->httpConnection, CURLOPT_POSTFIELDS, '['.$data.']');
        curl_setopt($this->httpConnection, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen('['.$data.']'),
        ]);

        Curl\Util::execute($this->httpConnection, 5, false);
    }
}
