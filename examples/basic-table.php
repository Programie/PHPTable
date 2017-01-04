<?php
use com\selfcoders\phptable\HeaderRow;
use com\selfcoders\phptable\Row;
use com\selfcoders\phptable\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

require_once __DIR__ . "/../vendor/autoload.php";

$output = new ConsoleOutput;

$table = new Table($output);

$headerRow = new HeaderRow;

$headerRow->addField("id", "ID");
$headerRow->addField("username", "Username");
$headerRow->addField("email", "Email address");

$table->setHeader($headerRow);

$row = new Row;

$row->addField("id", 1);
$row->addField("username", "example");
$row->addField("email", "me@example.com");

$table->addRow($row);

$row = new Row;

$row->addField("id", 2);
$row->addField("username", "someone");
$row->addField("email", "someone@example.com");

$table->addRow($row);

$table->render();