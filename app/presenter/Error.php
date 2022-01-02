<?php

namespace library\presenter;

class Error extends Main
{
    public function prepare()
    {
        $this->viewName = 'error';
        $this->data['title'] = $this->conf->TITLE;
        $this->data['errCode'] = "404";
        $this->data['errCaption'] = "404 - NotFound";
    }
}
