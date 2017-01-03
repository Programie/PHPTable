# Custom Symfony Console Table

This library features a custom version of the Table classes implemented in the [Symfony Console component](https://symfony.com/doc/current/components/console.html).

One of the main features is the ability to define the order of the table headers. After that, the order of the row columns is defined by keys. It does not matter in which order you add the fields to the rows, the header row will always define the order.