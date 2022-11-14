<?php

namespace SergiX44\Nutgram\Handlers;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Telegram\Attributes\MessageTypes;
use SergiX44\Nutgram\Telegram\Attributes\UpdateTypes;

/**
 * @mixin CollectHandlers
 */
trait MessageHandlers
{
    /**
     * @param  string  $command
     * @param $callable
     * @return Command
     */
    public function onCommand(string $command, $callable): Command
    {
        $command = "/$command";

        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::TEXT][$command] = new Command($callable, $command);
    }

    /**
     * @param  string  $pattern
     * @param $callable
     * @return Handler
     */
    public function onText(string $pattern, $callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::TEXT][$pattern] = new Handler($callable, $pattern);
    }

    /**
     * @param $callable
     * @return Handler
     */
    public function onSuccessfulPayment($callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::SUCCESSFUL_PAYMENT][] = new Handler($callable);
    }

    /**
     * @param  string  $pattern
     * @param $callable
     * @return Handler
     */
    public function onSuccessfulPaymentPayload(string $pattern, $callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::SUCCESSFUL_PAYMENT][$pattern] = new Handler(
            $callable,
            $pattern
        );
    }

    /**
     * @param $callable
     * @return Handler
     */
    public function onForumTopicCreated($callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::FORUM_TOPIC_CREATED][] = new Handler($callable);
    }

    /**
     * @param $callable
     * @return Handler
     */
    public function onForumTopicClosed($callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::FORUM_TOPIC_CLOSED][] = new Handler($callable);
    }

    /**
     * @param $callable
     * @return Handler
     */
    public function onForumTopicReopened($callable): Handler
    {
        return $this->handlers[UpdateTypes::MESSAGE][MessageTypes::FORUM_TOPIC_REOPENED][] = new Handler($callable);
    }
}