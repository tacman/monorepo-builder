<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210801\Symfony\Component\VarDumper\Server;

use MonorepoBuilder20210801\Psr\Log\LoggerInterface;
use MonorepoBuilder20210801\Symfony\Component\VarDumper\Cloner\Data;
use MonorepoBuilder20210801\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * A server collecting Data clones sent by a ServerDumper.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 *
 * @final
 */
class DumpServer
{
    private $host;
    private $socket;
    private $logger;
    public function __construct(string $host, \MonorepoBuilder20210801\Psr\Log\LoggerInterface $logger = null)
    {
        if (\strpos($host, '://') === \false) {
            $host = 'tcp://' . $host;
        }
        $this->host = $host;
        $this->logger = $logger;
    }
    public function start() : void
    {
        if (!($this->socket = \stream_socket_server($this->host, $errno, $errstr))) {
            throw new \RuntimeException(\sprintf('Server start failed on "%s": ', $this->host) . $errstr . ' ' . $errno);
        }
    }
    public function listen(callable $callback) : void
    {
        if (null === $this->socket) {
            $this->start();
        }
        foreach ($this->getMessages() as $clientId => $message) {
            if ($this->logger) {
                $this->logger->info('Received a payload from client {clientId}', ['clientId' => $clientId]);
            }
            $payload = @\unserialize(\base64_decode($message), ['allowed_classes' => [\MonorepoBuilder20210801\Symfony\Component\VarDumper\Cloner\Data::class, \MonorepoBuilder20210801\Symfony\Component\VarDumper\Cloner\Stub::class]]);
            // Impossible to decode the message, give up.
            if (\false === $payload) {
                if ($this->logger) {
                    $this->logger->warning('Unable to decode a message from {clientId} client.', ['clientId' => $clientId]);
                }
                continue;
            }
            if (!\is_array($payload) || \count($payload) < 2 || !$payload[0] instanceof \MonorepoBuilder20210801\Symfony\Component\VarDumper\Cloner\Data || !\is_array($payload[1])) {
                if ($this->logger) {
                    $this->logger->warning('Invalid payload from {clientId} client. Expected an array of two elements (Data $data, array $context)', ['clientId' => $clientId]);
                }
                continue;
            }
            [$data, $context] = $payload;
            $callback($data, $context, $clientId);
        }
    }
    public function getHost() : string
    {
        return $this->host;
    }
    private function getMessages() : iterable
    {
        $sockets = [(int) $this->socket => $this->socket];
        $write = [];
        while (\true) {
            $read = $sockets;
            \stream_select($read, $write, $write, null);
            foreach ($read as $stream) {
                if ($this->socket === $stream) {
                    $stream = \stream_socket_accept($this->socket);
                    $sockets[(int) $stream] = $stream;
                } elseif (\feof($stream)) {
                    unset($sockets[(int) $stream]);
                    \fclose($stream);
                } else {
                    (yield (int) $stream => \fgets($stream));
                }
            }
        }
    }
}
