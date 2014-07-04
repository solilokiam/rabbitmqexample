<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 29/06/14
 * Time: 16:58
 */

namespace Solilokiam\RabbitMQBundle\Consumers;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\The;
use PhpAmqpLib\Message\AMQPMessage;
use Solilokiam\RabbitMQBundle\Model\Translators\TranslatorInterface;

class StringCapitalizer implements ConsumerInterface
{
    protected $translator;

    function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param AMQPMessage The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        $stringCapitalizeMessage = $this->translator->translateMessage($msg);

        return strtoupper($stringCapitalizeMessage->getString());
    }


} 