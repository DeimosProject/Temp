<?php

namespace Deimos\Temp;

interface Temp
{

    public function write($data, $flags = 0);

    public function puts($data);

    public function read(...$data);

    public function delete();

    public function __toString();

}