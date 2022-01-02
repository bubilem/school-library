<?php


namespace library\model;

class Conf extends Main
{
    public function __construct(string $filename)
    {
        $this->load($filename);
    }

    public function load(string $filename): bool
    {
        if (file_exists($filename)) {
            $data = parse_ini_file($filename);
            if (!empty($data) && is_array($data)) {
                $this->data = $data;
                return true;
            }
        }
        return false;
    }
}
