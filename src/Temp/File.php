<?php

namespace Deimos\Temp;

use Deimos\Temp\Exceptions\CouldNotCreateFile;

class File extends AbstractTemp
{

    /**
     * @var string
     */
    public $filename;

    /**
     * File constructor.
     *
     * @param null $data
     *
     * @throws CouldNotCreateFile
     */
    public function __construct($data = null)
    {
        $this->filename = $this->create();

        register_shutdown_function([$this, 'delete']);

        if ($data)
        {
            $this->write($data);
        }
    }

    /**
     * @return string
     *
     * @throws CouldNotCreateFile
     */
    protected function create()
    {
        $filename = tempnam(sys_get_temp_dir(), uniqid(mt_rand(), true));

        if (!$filename)
        {
            throw new CouldNotCreateFile('The function `tempnam` could not create a temporary file.');
        }

        return $filename;
    }

    /**
     * @param string|resource $data
     * @param int             $flags
     *
     * @return int
     */
    public function write($data, $flags = 0)
    {
        return file_put_contents($this->filename, $data, $flags);
    }

    /**
     * @param string|resource $data
     *
     * @return int
     */
    public function puts($data)
    {
        return $this->write($data, FILE_APPEND);
    }

    /**
     * @param array ...$data
     *
     * @return mixed
     */
    public function read(...$data)
    {
        $args = array_merge(
            [$this->filename],
            [false, null],
            $data
        );

        return call_user_func_array('file_get_contents', $args);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return @unlink($this->filename);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->filename;
    }

}