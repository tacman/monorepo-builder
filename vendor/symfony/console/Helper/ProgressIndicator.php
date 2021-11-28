<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20211128\Symfony\Component\Console\Helper;

use MonorepoBuilder20211128\Symfony\Component\Console\Exception\InvalidArgumentException;
use MonorepoBuilder20211128\Symfony\Component\Console\Exception\LogicException;
use MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface;
/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ProgressIndicator
{
    private $output;
    private $startTime;
    private $format;
    private $message;
    private $indicatorValues;
    private $indicatorCurrent;
    private $indicatorChangeInterval;
    private $indicatorUpdateTime;
    private $started = \false;
    private static $formatters;
    private static $formats;
    /**
     * @param int        $indicatorChangeInterval Change interval in milliseconds
     * @param array|null $indicatorValues         Animated indicator characters
     */
    public function __construct(\MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface $output, string $format = null, int $indicatorChangeInterval = 100, array $indicatorValues = null)
    {
        $this->output = $output;
        if (null === $format) {
            $format = $this->determineBestFormat();
        }
        if (null === $indicatorValues) {
            $indicatorValues = ['-', '\\', '|', '/'];
        }
        $indicatorValues = \array_values($indicatorValues);
        if (2 > \count($indicatorValues)) {
            throw new \MonorepoBuilder20211128\Symfony\Component\Console\Exception\InvalidArgumentException('Must have at least 2 indicator value characters.');
        }
        $this->format = self::getFormatDefinition($format);
        $this->indicatorChangeInterval = $indicatorChangeInterval;
        $this->indicatorValues = $indicatorValues;
        $this->startTime = \time();
    }
    /**
     * Sets the current indicator message.
     * @param string|null $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->display();
    }
    /**
     * Starts the indicator output.
     * @param string $message
     */
    public function start($message)
    {
        if ($this->started) {
            throw new \MonorepoBuilder20211128\Symfony\Component\Console\Exception\LogicException('Progress indicator already started.');
        }
        $this->message = $message;
        $this->started = \true;
        $this->startTime = \time();
        $this->indicatorUpdateTime = $this->getCurrentTimeInMilliseconds() + $this->indicatorChangeInterval;
        $this->indicatorCurrent = 0;
        $this->display();
    }
    /**
     * Advances the indicator.
     */
    public function advance()
    {
        if (!$this->started) {
            throw new \MonorepoBuilder20211128\Symfony\Component\Console\Exception\LogicException('Progress indicator has not yet been started.');
        }
        if (!$this->output->isDecorated()) {
            return;
        }
        $currentTime = $this->getCurrentTimeInMilliseconds();
        if ($currentTime < $this->indicatorUpdateTime) {
            return;
        }
        $this->indicatorUpdateTime = $currentTime + $this->indicatorChangeInterval;
        ++$this->indicatorCurrent;
        $this->display();
    }
    /**
     * Finish the indicator with message.
     *
     * @param $message
     */
    public function finish($message)
    {
        if (!$this->started) {
            throw new \MonorepoBuilder20211128\Symfony\Component\Console\Exception\LogicException('Progress indicator has not yet been started.');
        }
        $this->message = $message;
        $this->display();
        $this->output->writeln('');
        $this->started = \false;
    }
    /**
     * Gets the format for a given name.
     *
     * @return string|null A format string
     * @param string $name
     */
    public static function getFormatDefinition($name)
    {
        if (!self::$formats) {
            self::$formats = self::initFormats();
        }
        return self::$formats[$name] ?? null;
    }
    /**
     * Sets a placeholder formatter for a given name.
     *
     * This method also allow you to override an existing placeholder.
     * @param string $name
     * @param callable $callable
     */
    public static function setPlaceholderFormatterDefinition($name, $callable)
    {
        if (!self::$formatters) {
            self::$formatters = self::initPlaceholderFormatters();
        }
        self::$formatters[$name] = $callable;
    }
    /**
     * Gets the placeholder formatter for a given name (including the delimiter char like %).
     *
     * @return callable|null A PHP callable
     * @param string $name
     */
    public static function getPlaceholderFormatterDefinition($name)
    {
        if (!self::$formatters) {
            self::$formatters = self::initPlaceholderFormatters();
        }
        return self::$formatters[$name] ?? null;
    }
    private function display()
    {
        if (\MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET === $this->output->getVerbosity()) {
            return;
        }
        $this->overwrite(\preg_replace_callback("{%([a-z\\-_]+)(?:\\:([^%]+))?%}i", function ($matches) {
            if ($formatter = self::getPlaceholderFormatterDefinition($matches[1])) {
                return $formatter($this);
            }
            return $matches[0];
        }, $this->format ?? ''));
    }
    private function determineBestFormat() : string
    {
        switch ($this->output->getVerbosity()) {
            // OutputInterface::VERBOSITY_QUIET: display is disabled anyway
            case \MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE:
                return $this->output->isDecorated() ? 'verbose' : 'verbose_no_ansi';
            case \MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE:
            case \MonorepoBuilder20211128\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_DEBUG:
                return $this->output->isDecorated() ? 'very_verbose' : 'very_verbose_no_ansi';
            default:
                return $this->output->isDecorated() ? 'normal' : 'normal_no_ansi';
        }
    }
    /**
     * Overwrites a previous message to the output.
     */
    private function overwrite(string $message)
    {
        if ($this->output->isDecorated()) {
            $this->output->write("\r\33[2K");
            $this->output->write($message);
        } else {
            $this->output->writeln($message);
        }
    }
    private function getCurrentTimeInMilliseconds() : float
    {
        return \round(\microtime(\true) * 1000);
    }
    private static function initPlaceholderFormatters() : array
    {
        return ['indicator' => function (self $indicator) {
            return $indicator->indicatorValues[$indicator->indicatorCurrent % \count($indicator->indicatorValues)];
        }, 'message' => function (self $indicator) {
            return $indicator->message;
        }, 'elapsed' => function (self $indicator) {
            return \MonorepoBuilder20211128\Symfony\Component\Console\Helper\Helper::formatTime(\time() - $indicator->startTime);
        }, 'memory' => function () {
            return \MonorepoBuilder20211128\Symfony\Component\Console\Helper\Helper::formatMemory(\memory_get_usage(\true));
        }];
    }
    private static function initFormats() : array
    {
        return ['normal' => ' %indicator% %message%', 'normal_no_ansi' => ' %message%', 'verbose' => ' %indicator% %message% (%elapsed:6s%)', 'verbose_no_ansi' => ' %message% (%elapsed:6s%)', 'very_verbose' => ' %indicator% %message% (%elapsed:6s%, %memory:6s%)', 'very_verbose_no_ansi' => ' %message% (%elapsed:6s%, %memory:6s%)'];
    }
}
