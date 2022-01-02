<?php

namespace library\model;

use library\utils\Str;

class Book extends Main
{

    public function __construct(array $data)
    {
        $this->generateAllAttributes($data);
        $this->generateFilterAttributes();
    }

    private function generateAllAttributes(array $data)
    {
        foreach (Attributes::$all as $attribute) {
            $this->{$attribute} = $data[$attribute] ?? '';
        }
    }

    private function generateFilterAttributes()
    {
        $filterAttributes = [];
        foreach (Attributes::$filter as $fKey => $fAttribs) {
            foreach ($fAttribs as $fAttrib) {
                if (empty($filterAttributes[$fKey])) {
                    $filterAttributes[$fKey] = Str::toSimple($this->{$fAttrib});
                } else {
                    $filterAttributes[$fKey] .= ' ' . Str::toSimple($this->{$fAttrib});
                }
            }
        }
        $this->filter = $filterAttributes;
    }

    public function addId($id)
    {
        $this->data['id'][] = $id;
    }

    public function toJson(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}
