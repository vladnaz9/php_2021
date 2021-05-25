<?php

/**
 * Class Logger
 * @abstract
 */
abstract class Logger
{
    /**
     * @param $string
     * @return mixed
     */
    abstract public function writeString($string);


}
