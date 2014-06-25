<?php

namespace Solilokiam\RabbitMQBundle\Consumers;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class MakeThumbnailConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        $data = json_decode($msg->body,true);

        $imagine = new Imagine();

        try
        {
            $imagine->open($data['original_image_path'])
                ->resize(new Box($data['width'],$data['height']))
                ->save($data['destination_image_path']);
        } catch(\Exception $e) {
            return false;
        }

        return true;
    }

} 