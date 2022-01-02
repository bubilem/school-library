<?php

namespace library\model;

use library\utils\Str;

class Books extends Main
{
    public function __construct()
    {
        $this->loadBooks();
        $this->attributes = new Attributes($this);
    }

    private function loadBooks()
    {
        $register = [];
        $attributes = [];
        $files = glob('data/books/*.csv');
        foreach ($files as $file) {
            $content = explode("\n", iconv('CP1250', 'UTF-8', file_get_contents($file)));
            if (empty($content) || !is_array($content)) {
                return;
            }
            $department = strtoupper(basename($file, '.csv'));
            for ($i = 0; $i < count($content); $i++) {
                if (empty($content[$i])) {
                    break;
                }
                if ($i == 0) {
                    $attributes = explode(";", trim($content[$i]));
                } else {
                    $data = [];
                    $row = explode(";", trim($content[$i]));
                    if (empty($row[0])) {
                        break;
                    }
                    foreach ($attributes as $key => $val) {
                        $data[$val] = trim($row[$key]);
                    }
                    $data['id'] = [$data['id']];
                    $data['department'] = $department;
                    $bookKey = Str::toSimple($data['name'] . "-" . $data['year']);
                    if (!isset($register[$bookKey])) {
                        $book = new Book($data);
                        $this->addBook($book);
                        $register[$bookKey] = $book;
                    } else {
                        $register[$bookKey]->addId($data['id'][0]);
                    }
                }
            }
        }
    }

    public function getBooks(): array
    {
        return $this->data['books'] ?? [];
    }

    public function addBook(Book $book): void
    {
        $this->data['books'][] = $book;
    }

    public function getBook(int $key): ?Book
    {
        return $this->data['books'][$key] ?? null;
    }

    public function toJson(): string
    {
        $names = [];
        foreach ($this->getBooks() as $key => $book) {
            $names[$key] = trim($book->name);
        }
        asort($names);
        $books = '';
        foreach ($names as $key => $name) {
            $book = $this->getBook($key);
            $books .= ($books ? ', ' : '') . $book->toJson();
        }
        return '[' . $books . ']';
    }
}
