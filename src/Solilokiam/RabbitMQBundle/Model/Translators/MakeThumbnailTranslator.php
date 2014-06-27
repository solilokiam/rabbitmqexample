<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 27/06/14
 * Time: 23:12
 */

namespace Solilokiam\RabbitMQBundle\Translators;


use Solilokiam\RabbitMQBundle\Message\MakeThumbnailMessage;

class MakeThumbnailTranslator implements TranslatorInterface
{
    public function translateMessage($message)
    {
        $data = json_encode($message->body);

        if(json_last_error() !== JSON_ERROR_NONE)
        {
            throw new \Exception('WrongMessage');
        }

        $makeThumbnailMessage = new MakeThumbnailMessage();
        $makeThumbnailMessage->setOriginalImagePath($data['original_image_path']);
        $makeThumbnailMessage->setDestinationImagePath($data['destination_image_path']);
        $makeThumbnailMessage->setWidth($data['width']);
        $makeThumbnailMessage->setHeight($data['height']);

        return $makeThumbnailMessage;
    }

} 