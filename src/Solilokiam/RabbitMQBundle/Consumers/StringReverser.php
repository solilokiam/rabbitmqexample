<?php

namespace Solilokiam\RabbitMQBundle\Consumers;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\The;
use PhpAmqpLib\Message\AMQPMessage;
use Solilokiam\RabbitMQBundle\Model\Translators\TranslatorInterface;

class StringReverser implements ConsumerInterface
{
    protected $translator;

    function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function execute(AMQPMessage $msg)
    {
        $stringReverseMessage = $this->translator->translateMessage($msg);

        return strrev($stringReverseMessage->getString());
    }

} 