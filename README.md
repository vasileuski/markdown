# Markdown PHP Library 
[![Build Status](https://travis-ci.org/vasileuski/markdown.svg?branch=master)](https://travis-ci.org/vasileuski/markdown)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

#### Example
###### Code

```php
$md = new \Vasileuski\Markdown\Markdown();

echo $md->h1('Hello');
echo $md->h2('Markdown');
```

###### Output

```markdown
# Hello

## Markdown
```

#### Example with Buffer
###### Code

```php
$md = new \Vasileuski\Markdown\Markdown();
$buffer = new \Vasileuski\Markdown\Buffer();

$buffer->add(
    $md->h1('Heading1'),
    $md->list(['Item 1', 'Item 2'])
);

echo $buffer->out(false); // Get output. Buffer still contains content
echo $buffer;             // The same as above
echo $buffer->out();      // Get output. Buffer is clear
echo $buffer;             // Empty output
```

###### Output

```markdown
# Heading1

1. Item 1
2. Item 2

# Heading1

1. Item 1
2. Item 2

# Heading1

1. Item 1
2. Item 2
```

#### Example with multiple Buffers
###### Code

```php
$md     = new \Vasileuski\Markdown\Markdown();
$buffer = new \Vasileuski\Markdown\Buffer();

$header  = $buffer->new()->add($md->h2('Header'));
$content = $buffer->new()->add($md->h2('Content'));
$footer  = $buffer->new()->add($md->h2('Footer'));

echo $buffer->add($header, $content, $footer);
```

###### Output

```markdown
## Header

## Content

## Footer
```

#### Heading
###### Code

```php
echo $md->h1('H1');
echo $md->h2('H2');
echo $md->h3('H3');
echo $md->h4('H4');
echo $md->h5('H5');
echo $md->h6('H6');
```

###### Output

```markdown

# H1

## H2

### H3

#### H4

##### H5

###### H6

```

#### Text Formatting
###### Code

```php
echo $md->bold('Bolded') . PHP_EOL;
echo $md->italic('Italic') . PHP_EOL;
echo $md->bold($md->italic('Bolded Italic')) . PHP_EOL;
echo $md->striked('Striked') . PHP_EOL;
```

###### Output

```markdown
__Bolded__
_Italic_
___Bolded Italic___
~~Striked~~
```

#### Quote
###### Code

```php
echo $md->quote('Some Quote Sample (c) John Doe');
```

###### Output

```markdown
> Some Quote Sample (c) John Doe
```

#### Code
###### Code

```php
echo $md->code('$this->someInlineCode()') . PHP_EOL;
echo $md->code(json_encode(['some' => 'json'], JSON_PRETTY_PRINT), false, 'json');
```

###### Output

```markdown
`$this->someInlineCode()`

```json
{
    "some": "json"
}
``
```

#### List
###### Code

```php
echo $md->list(['Item 1', 'Item 2']);
echo $md->list(['Item 1', 'Item 2'], false);
```

###### Output

```markdown
1. Item 1
2. Item 2

- Item 1
- Item 2
```

#### Table
###### Code

```php
echo $md->table([
    [ 'Head 1', 'Head 2' ],
    [ '1x1', '1x2' ],
    [ '2x1', '2x2' ],
]);
```

###### Output

```markdown
Head 1|Head 2
---|---
1x1|1x2
2x1|2x2
```

#### Link
###### Code

```php
echo $md->link('Some Link', 'http://example.com/');
```

###### Output

```markdown
[Some Link](http://example.com/)
```

#### Image
###### Code

```php
echo $md->image('Some Image', 'http://example.com/image.png');
```

###### Output

```markdown
![Some Image](http://example.com/image.png)
```

#### Divider
###### Code

```php
echo $md->divider();
```

###### Output

```markdown

----

```

#### Inline
###### Code

```php
echo $md->inline('Text' . PHP_EOL . 'With' . PHP_EOL . 'EOL');
```

###### Output

```markdown
TextWithEOL
```

#### Escape
Escaped characters:
  \ ` * _ { } [ ] ( ) # + - . !
###### Code

```php
echo $md->escape('*String#With(Escaped)Characters');
```

###### Output

```markdown
\*String\#With\(Escaped\)Characters
```

#### Comment
###### Code

```php
echo $md->comment('Hidden text');
```

###### Output

```markdown
[comment]: # (Hidden text)
```
