<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 27/06/14
 * Time: 23:15
 */

namespace Solilokiam\RabbitMQBundle\Model\Message;


class MakeThumbnailMessage
{
    protected $originalImagePath;
    protected $destinationImagePath;
    protected $width;
    protected $height;

    /**
     * @param mixed $destinationImagePath
     */
    public function setDestinationImagePath($destinationImagePath)
    {
        $this->destinationImagePath = $destinationImagePath;
    }

    /**
     * @return mixed
     */
    public function getDestinationImagePath()
    {
        return $this->destinationImagePath;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $originalImagePath
     */
    public function setOriginalImagePath($originalImagePath)
    {
        $this->originalImagePath = $originalImagePath;
    }

    /**
     * @return mixed
     */
    public function getOriginalImagePath()
    {
        return $this->originalImagePath;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }


} 