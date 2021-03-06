# String Utilities

A few miscellanous PHP string utilities.


## Strip Punctuation

As the name suggests, the `stripPunctuation()` method strips all punctuation from a string.

```php
Strings::stripPunctuation( 
	'This, is a sentence, with - some - punctuation.' 
);
// outputs This is a sentence with  some  punctuation
```

> To avoid the addtional spaces where the dashes have been replaced, see `stripMultipleSpaces()`

## Strip Multiple Spaces

The `stripMultipleSpaces()` strips multiple spaces:

```php
Strings::stripMultipleSpaces(
	'This is  a string that has  some extra spaces'
);
// outputs This is a string that has some extra spaces
```

## Replace the nth Occurence of a Substring

If you have a string that contains multiple occurences of a given substring, but only want to replace a specific one, use `replaceNth()`.

```php
Strings::replaceNth( '0', '1', '0000000000', 5 );
// Outputs 0000100000
```

## Replace All But First Occurence of a Substring

If you have a string that contains multiple occurences of a given substring, but want to replace all but the first one then use `replaceAllButFirstOccurence()`.

```php
Strings::replaceAllButFirstOccurence( '0', '1', '0000000000' );
// Outputs 0111111111
```

## Random Hex String

The `randomHex()` method returns a random hexadecimal number, as a string, to the specified length.

```php
Strings::randomHex( 5 );
// Outputs something like de0f42
```

To force it to be uppercase, pass `true` as the second argument.

```php
Strings::randomHex( 5, true );
// Outputs something like DE0F42
```

## Starts With

Use `startsWith()` to determine whether a string starts with a specified substring.

```php
Strings::startsWith( 'This is a test', 'This' )
// true
```

By default, the method is case sensitive. To make it case-insensitive, pass `false` as a third argument.

```php
Strings::startsWith( 'This is a test', 'this', false )
// true
```

## Ends With

Use `endsWith()` to determine whether a string ends with a specified substring.

```php
Strings::startsWith( 'This is a test', 'test' )
// true
```

By default, the method is case sensitive. To make it case-insensitive, pass `false` as a third argument.

```php
Strings::startsWith( 'This is a test', 'Test', false )
// true
```

## Generate an Excerpt

To generate an exceprt; as in, trim a string to a specified maximum number of words:

```php
$excerpt = Strings::excerpt( $content, 25 );
```

By default this appends `...` to the end of the string; change this using the optional third argument, for example:

```php
$excerpt = Strings::excerpt( 
	$content, 
	100,
	'<a href="/path/to/page">Read More</a>'
);
```

Alternatively, if you need to limit the length of the excerpt to a specified number of characters:

```php
$excerpt = Strings::excerptCharacters( $content, 200 );
```
