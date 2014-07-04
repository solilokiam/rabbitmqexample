<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 29/06/14
 * Time: 16:25
 */

namespace Solilokiam\RabbitMQBundle\Model\Message;


class StringReverseMessage
{
    protected $string;

    /**
     * @param mixed $string
     */
    public function setString($string)
    {
        $this->string = $string;
    }

    /**
     * @return mixed
     */
    public function getString()
    {
        return $this->string;
    }


} 