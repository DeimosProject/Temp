<?php

namespace Deimos\Temp;

abstract
class AbstractTemp implements Temp
{

    /**
     * @return mixed
     */
    abstract protected function create();

}