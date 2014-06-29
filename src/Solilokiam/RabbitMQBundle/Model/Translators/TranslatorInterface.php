<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 27/06/14
 * Time: 23:11
 */

namespace Solilokiam\RabbitMQBundle\Model\Translators;


interface TranslatorInterface
{
    public function translateMessage($message);
} 