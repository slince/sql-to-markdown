<?php

namespace Slince\SqlToMarkdown;

class Schema
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var Column[]
     */
    protected $columns;

    public function __construct(array $array = [])
    {
        foreach ($array as $name => $value) {
            $method = 'set' . ucfirst($name);
            method_exists($this, $method) && call_user_func([$this, $method], $value);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Column[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param Column[] $columns
     */
    public function setColumns($columns)
    {
        $this->columns = [];
        foreach ($columns as $column) {
            $this->addColumn($column);
        }
    }

    /**
     * Add a column.
     *
     * @param Column|array $column
     */
    public function addColumn($column)
    {
        $column = $column instanceof Column ? $column : Column::fromArray($column);
        $this->columns[] = $column;
    }

    /**
     * Creates from array.
     *
     * @param array $array
     * @return Schema
     */
    public static function fromArray($array)
    {
        return new static($array);
    }
}