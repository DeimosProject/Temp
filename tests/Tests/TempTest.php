<?php

namespace Test;

use Deimos\Temp\File;

class TempTest extends \PHPUnit_Framework_TestCase
{
    public function testTemp()
    {
        $content = uniqid(mt_rand(), true);

        $temp = new File('These data will be overwritten below');

        $temp->write($content);

        $this->assertEquals(
            $temp->read(),
            $content
        );
        $this->assertEquals(
            file_get_contents('' . $temp),
            $content
        );

        $data = ' need more data!';
        $temp->puts($data);

        $this->assertEquals(
            $temp->read(),
            $content . $data
        );

        $temp->delete();
        $this->assertFalse(is_file('' . $temp));
    }
}