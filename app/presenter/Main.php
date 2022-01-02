<?php

namespace library\presenter;

use library\controller\View;

abstract class Main

{
    protected $conf;
    protected $params;
    protected $data = [];
    protected $viewName = '';

    public function __construct(\library\model\Conf $conf, array $params)
    {
        $this->conf = $conf;
        $this->params = $params;
    }

    protected function prepare()
    {
    }

    public function execute()
    {
        $this->prepare();
        echo new View($this->viewName, $this->data);
    }

    public function redirect(string $uri)
    {
        header("Location: " . (strpos($uri, 'http') === 0 ? '' : $this->conf->URL_BASE . $this->conf->URL_DIR) . $uri);
        header("Connection: close");
        exit;
    }
}
