<?php

namespace library\presenter;

use library\controller\View;
use library\model\Attributes;
use library\model\Books;

class Catalog extends Main
{
    public function prepare()
    {
        $this->viewName = 'catalog';
        $this->data['title'] = $this->conf->TITLE;
        $this->data['version'] = "version " . $this->conf->VERSION;
        $this->data['webmaster'] = new View("html-a", [
            'href' => "mailto:" . $this->conf->ADMIN_EMAIL,
            'caption' => $this->conf->ADMIN_NAME
        ]);
        $books = new Books();
        $this->data['books'] = $books->toJson();
        foreach (Attributes::$filter as $attribKey => $val) {
            $checkboxItems = '';
            foreach ($books->attributes->getAttributeValues($attribKey) as $key => $values) {
                $checkboxItems .= new View("html-button", [
                    'attribute-key' => $attribKey,
                    'value-key' => $values['key'],
                    'label' => $values['name'],
                    'label-small' => $values['count']
                ]);
            }
            $this->data["filter-$attribKey"] = $checkboxItems;
        }
    }
}
