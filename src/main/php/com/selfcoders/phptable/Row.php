<?php
namespace com\selfcoders\phptable;

class Row
{
    /**
     * @var Field[]
     */
    public $fields = array();
    /**
     * @var string
     */
    public $prefix;
    /**
     * @var string
     */
    public $suffix;
    /**
     * @var string
     */
    public $contentFormat = " %s ";

    /**
     * @param string $name
     * @param string $content
     * @return Field
     */
    public function addField($name, $content)
    {
        $field = new Field($name, $content);

        $this->fields[$field->name] = $field;

        return $field;
    }

    /**
     * Get an array containing the length of each field in this row.
     *
     * @return array
     */
    public function getFieldLengths()
    {
        $lengths = array();

        foreach ($this->fields as $field) {
            $lengths[$field->name] = strlen(strip_tags($this->formatContent($field->content)));
        }

        return $lengths;
    }

    /**
     * @param string $content
     * @return string
     */
    public function formatContent($content)
    {
        return sprintf($this->contentFormat, $content);
    }

    /**
     * Render the row and return it as a string.
     *
     * @param array $columnOrder
     * @param array $fieldLengths
     * @return string
     */
    public function render(array $columnOrder, array $fieldLengths)
    {
        $fields = array();

        foreach ($columnOrder as $index => $name) {
            if (isset($this->fields[$name])) {
                $content = $this->fields[$name]->content;
            } else {
                $content = "";
            }

            $content = $this->formatContent($content);

            $whitespaces = $fieldLengths[$name] - strlen(strip_tags($content));

            $fields[$index] = $content . str_repeat(" ", $whitespaces);
        }

        ksort($fields);

        $line = sprintf("|%s|", implode("|", $fields));

        if ($this->prefix !== null) {
            $line = $this->prefix . $line;
        }

        if ($this->suffix !== null) {
            $line .= $this->suffix;
        }

        return $line;
    }
}