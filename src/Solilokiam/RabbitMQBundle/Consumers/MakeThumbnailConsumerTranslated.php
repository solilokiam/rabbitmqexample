<?php

namespace Solilokiam\RabbitMQBundle\Consumers;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Solilokiam\RabbitMQBundle\Model\Translators\TranslatorInterface;

class MakeThumbnailConsumerTranslated implements ConsumerInterface
{
    protected $translator;

    function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }


    public function execute(AMQPMessage $msg)
    {
        try
        {
            $makeThumbnailMsg = $this->translator->translateMessage($msg);
            $imagine = new Imagine();
            $imagine->open($makeThumbnailMsg->getOriginalImagePath())
                ->resize(new Box($makeThumbnailMsg->getWidth(),$makeThumbnailMsg->getHeight()))
                ->save($makeThumbnailMsg->getDestinationImagePath());
        } catch(\Exception $e) {
            echo $e->getMessage();
            die();
            return false;
        }

        return true;
    }

} 