<?php

namespace library\controller;

class View
{
    private $name;
    private $data;

    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function __toString()
    {
        if (($content = file_get_contents("app/view/{$this->name}.html")) !== false) {
            foreach ($this->data as $key => $val) {
                $content = str_replace('{' . $key . '}', $val, $content);
            }
            return $content;
        }
        return '';
    }
}
