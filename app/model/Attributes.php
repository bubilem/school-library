<?php

namespace library\model;

use library\utils\Str;

class Attributes extends Main
{

    public static $all = [
        'department', 'id', 'isbn', 'name',
        'author', 'publishing', 'year', 'language',
        'pageCount', 'price', 'difficulty', 'wordCount',
        'level', 'genre1', 'genre2', 'accessories'
    ];

    public static $filter = [
        'dep' => ['department'],
        'lng' => ['language'],
        'gnr' => ['genre1', 'genre2'],
        'dfc' => ['difficulty']
    ];

    public function __construct(Books $books)
    {
        $this->books = $books;
        $this->generateAllFilterAttributes();
    }

    private function generateAllFilterAttributes()
    {
        $tmp = [];
        foreach ($this->books->getBooks() as $book) {
            foreach (self::$filter as $fKey => $fAttribs) {
                foreach ($fAttribs as $fAttrib) {
                    $tmp[$fKey][$book->{$fAttrib}] = empty($tmp[$fKey][$book->{$fAttrib}]) ? 1 : $tmp[$fKey][$book->{$fAttrib}] + 1;
                }
            }
        }
        foreach ($tmp as $key => $val) {
            ksort($tmp[$key]);
        }
        $data = [];
        foreach ($tmp as $fKey => $fAttribs) {
            foreach ($fAttribs as $fAttribValue => $fAttribCount) {
                if ($fAttribValue && $fAttribValue != '-') {
                    $data[$fKey][] = [
                        'key' => Str::toSimple($fAttribValue),
                        'name' => strval($fAttribValue),
                        'count' => $fAttribCount,
                    ];
                }
            }
        }
        $this->attributes = $data;
    }

    public function getAttributeValues(string $attribute)
    {
        return $this->data['attributes'][$attribute] ?? [];
    }

    public function toJson(): string
    {
        return json_encode($this->attributes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
