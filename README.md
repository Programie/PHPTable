# PHP Table

This library provides a simple API to display data in a table. It heavily depends on the [Symfony Console component](https://symfony.com/doc/current/components/console.html) to output the data to the console or any other output.

One of the main features is the ability to define the order of the table headers. After that, the order of the row columns is defined by keys. It does not matter in which order you add the fields to the rows, the header row will always define the order.

[![License](https://poser.pugx.org/programie/phptable/license.svg)](https://packagist.org/packages/programie/phptable)
[![Latest Stable Version](https://poser.pugx.org/programie/phptable/v/stable.svg)](https://packagist.org/packages/programie/phptable)
[![Latest Unstable Version](https://poser.pugx.org/programie/phptable/v/unstable.svg)](https://packagist.org/packages/programie/phptable)
[![Total Downloads](https://poser.pugx.org/programie/phptable/downloads.svg)](https://packagist.org/packages/programie/phptable)

## Installation

Add the composer package "programie/phptable" to the required packages of your composer.json:

```bash
composer require programie/phptable
```