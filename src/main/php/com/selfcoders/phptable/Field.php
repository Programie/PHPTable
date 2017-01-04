<?php
namespace com\selfcoders\phptable;

class Field
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $content;
    /**
     * @var bool
     */
    public $hideEmpty = false;

    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * Check whether this field has any content.
     *
     * @return bool
     */
    public function hasContent()
    {
        if ($this->content === null) {
            return false;
        }

        if (trim($this->content) === "") {
            return false;
        }

        return true;
    }
}