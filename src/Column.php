<?php

namespace Slince\SqlToMarkdown;

class Column
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $length;

    /**
     * @var string
     */
    protected $default;

    /**
     * @var string
     */
    protected $comment;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param string $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
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
     * Convert To Array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'length' => $this->length,
            'default' => $this->default,
            'comment' => $this->comment
        ];
    }

    /**
     * Creates from array.
     *
     * @param array $array
     * @return Column
     */
    public static function fromArray($array)
    {
        return new static($array);
    }
}