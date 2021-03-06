<?php

namespace library\presenter;

class BooksJson extends Main
{
    public function execute()
    {
        header("Content-type: application/json; charset=utf-8");
        header("Expires: on, 01 Jan 1970 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        echo (new \library\model\Books())->toJson();
    }
}
