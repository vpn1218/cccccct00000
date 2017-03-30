# PSR-1: Basic Coding Standard
# PSR-1: 基本编码标准

This section of the standard comprises what should be considered the standard coding elements that are required to ensure a high level of technical interoperability between shared PHP code.

> 标准的这一部分包括应该考虑的标准编码元素，以确保共享PHP代码之间的高水平的技术互操作性。

The key words “MUST”, “MUST NOT”, “REQUIRED”, “SHALL”, “SHALL NOT”, “SHOULD”, “SHOULD NOT”, “RECOMMENDED”, “MAY”, and “OPTIONAL” in this document are to be interpreted as described in RFC 2119.

> 本文档中的关键词“MUST”，“MUST NOT”，“REQUIRED”，“SHALL”，“SHALL NOT”，“SHOULD”，“SHOULD NOT”，“RECOMMENDED”，“MAY”和“OPTIONAL”以如RFC 2119中所描述的来解释。

#### 1.OverView

#### 1.概览

>   * Files MUST use only <?php and <?= tags.
>   * 标签只能使用<?php  或者 <?= tags
>   * Files MUST use only UTF-8 without BOM for PHP code.
>   * 文件只能使用不含bom头的utf-8编码的文件
>   * Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both.
>   * 文件要么用来声明 类，函数，常量等 或者 用于其他作用，生成，输出，改变 .ini文件等。但不要同时在一个文件中。
>   * Namespaces and classes MUST follow an “autoloading” PSR: [PSR-0, PSR-4]
>   * 命名空间和类 必须符合psr-0 和psr-4自动加载规范
>   * Class names MUST be declared in StudlyCaps
>   * 类名必须在studlycaps中声明
>   * Class constants MUST be declared in all upper case with underscore separators.
>   * 类常量的声明必须带下划线并用大写字母。
>   * Method names MUST be declared in camelCase
>   * 方法名必须用驼峰命名法

#### 2.Files

#### 2.文件

##### 2.1 php tags
    PHP code MUST use the long <?php ?> tags or the short-echo <?= ?> tags; it MUST NOT use the other tag variations.

    php代码必须用长标签<?php ?>或者短echo <?= ?>标签。其他形式的标签不要使用

##### 2.2 Character Encoding 字符编码
    PHP code MUST use only UTF-8 without BOM.

    php字符编码必须使用不含bom头的utf-8的编码

##### 2.3 Side Effects 副作用
A file SHOULD declare new symbols (classes, functions, constants, etc.) and cause no other side effects, or it SHOULD execute logic with side effects, but SHOULD NOT do both.

一个文件要么用来声明类，函数，常量，不做其他事，或者执行一些副作用逻辑，但不该同时使用。

The phrase “side effects” means execution of logic not directly related to declaring classes, functions, constants, etc., merely from including the file

“Side effects” include but are not limited to: generating output, explicit use of require or include, connecting to external services, modifying ini settings, emitting errors or exceptions, modifying global or static variables, reading from or writing to a file, and so on.

The following is an example of a file with both declarations and side effects; i.e, an example of what to avoid:

```php 
<?php
    // side effect: change ini settings
    ini_set('error_reporting', E_ALL);

    // side effect: loads a file
    include "file.php";

    // side effect: generates output
    echo "<html>\n";

    // declaration
    function foo()
    {
        // function body
    }
?>
```

The following example is of a file that contains declarations without side effects; i.e., an example of what to emulate:

```php
<?php
    // declaration
    function foo()
    {
        // function body
    }

    // conditional declaration is *not* a side effect
    if (! function_exists('bar')) {
        function bar()
        {
            // function body
        }
    }
?>
```

##### Namespace and Class Names

Namespaces and classes MUST follow an “autoloading” PSR: [PSR-0, PSR-4].

This means each class is in a file by itself, and is in a namespace of at least one level: a top-level vendor name.

Class names MUST be declared in StudlyCaps.

Code written for PHP 5.3 and after MUST use formal namespaces.

For example:

```php
<?php
    // PHP 5.3 and later:
    namespace Vendor\Model;

    class Foo
    {
    }
?>
```

Code written for 5.2.x and before SHOULD use the pseudo-namespacing convention of Vendor_ prefixes on class names.

```php
<?php
    // PHP 5.2.x and earlier:
    class Vendor_Model_Foo
    {
    }
?>
```

##### Class Constants, Properties, and Methods

The term “class” refers to all classes, interfaces, and traits.

#### Constants
Class constants MUST be declared in all upper case with underscore separators. For example:
```php
<?php
namespace Vendor\Model;

class Foo
{
    const VERSION = '1.0';
    const DATE_APPROVED = '2012-06-01';
}

?>
```
#### Properties
This guide intentionally avoids any recommendation regarding the use of $StudlyCaps, $camelCase, or $under_score property names.

Whatever naming convention is used SHOULD be applied consistently within a reasonable scope. That scope may be vendor-level, package-level, class-level, or method-level.

#### Methods

Method names MUST be declared in camelCase().

