<?php
namespace com\selfcoders\phptable;

use Symfony\Component\Console\Output\OutputInterface;

class Table
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var HeaderRow
     */
    private $headerRow;
    /**
     * @var Row[]
     */
    private $rows = array();

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param HeaderRow $headerRow
     */
    public function setHeader(HeaderRow $headerRow)
    {
        $this->headerRow = $headerRow;
    }

    /**
     * @param Row $row
     */
    public function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @return array
     */
    private function getMaxFieldLengths()
    {
        $maxFieldLengths = array();

        /**
         * @var $row Row
         */
        foreach (array_merge(array($this->headerRow), $this->rows) as $row) {
            foreach ($row->getFieldLengths() as $name => $length) {
                if (!isset($maxFieldLengths[$name])) {
                    $maxFieldLengths[$name] = 0;
                }

                if ($length > $maxFieldLengths[$name]) {
                    $maxFieldLengths[$name] = $length;
                }
            }
        }

        return $maxFieldLengths;
    }

    /**
     * Render the table to the output.
     */
    public function render()
    {
        $columnOrder = array();

        foreach ($this->headerRow->fields as $field) {
            if ($field->hideEmpty) {
                $columnHasContent = false;

                foreach ($this->rows as $row) {
                    if (isset($row->fields[$field->name]) and $row->fields[$field->name]->hasContent()){
                        $columnHasContent = true;
                        break;
                    }
                }

                // Skip this column if there is no content in any row
                if (!$columnHasContent) {
                    continue;
                }
            }

            $columnOrder[] = $field->name;
        }

        $fieldLengths = $this->getMaxFieldLengths();

        $fields = array();

        foreach ($columnOrder as $name) {
            $fields[] = str_repeat("-", $fieldLengths[$name]);
        }

        $separator = sprintf("+%s+", implode("+", $fields));

        $this->output->writeln($separator);

        $this->output->writeln($this->headerRow->render($columnOrder, $fieldLengths));

        $this->output->writeln($separator);

        foreach ($this->rows as $row) {
            $this->output->writeln($row->render($columnOrder, $fieldLengths));
        }

        if (!empty($this->rows)) {
            $this->output->writeln($separator);
        }
    }
}