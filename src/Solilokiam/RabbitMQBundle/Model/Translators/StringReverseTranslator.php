<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 29/06/14
 * Time: 16:25
 */

namespace Solilokiam\RabbitMQBundle\Model\Translators;


use Solilokiam\RabbitMQBundle\Model\Message\StringReverseMessage;

class StringReverseTranslator implements TranslatorInterface
{
    public function translateMessage($message)
    {
        $data = json_decode($message->body,true);

        $stringReverseMessage = new StringReverseMessage();
        $stringReverseMessage->setString($data['string']);

        return $stringReverseMessage;
    }

} 