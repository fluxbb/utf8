PHP-UTF8
========

Introduction
------------

PHP-UTF-8 is a UTF-8 aware library of functions mirroring PHP's own string functions. Does not require PHP mbstring extension though will use it, if found, for a (small) performance gain.

**IMPORTANT NOTE:** *I, Frank Smit, am going to try to maintain this project by forking it. Its name is now PHP-UTF8 instead of phputf8. The stuff that needs to be done can be found in the TODO file.*

Documentation
-------------

Please read on the following resources:

  - [Character Sets / Character Encoding Issues][1]
  - [Handling UTF-8 with PHP][2]

Use these functions **only if you really need** them & you understand **why you need** to use them. In particular, do not blindly replace all use of PHP's string functions which functions found here - most of the time you will not need to, and you will be introducing a significant performance overhead to your application. You can get a good idea of when to use what from reading [Handling UTF-8 with PHP][3].

For sake of performance most of the functions here are not operating *defensively*. For example there is no extensive parameter checking and it is assumed that they are fed with well formed UTF-8. This is particularly relevant when is comes to catching badly formed UTF-8 - you should screen input on the *outer perimeter* with help from functions in the `utf8_validation.php` and `utf8_bad.php` files.

**All** ASCII characters, including ASCII control characters, are treated as valid throughout the library. But if you use some ASCII control characters in XML, it will render the XML ill-formed. Read on [Don't be a bozo][4]

Bugs, Support, Feature Requests
---------------------------------

Please report bugs to: http://github.com/FSX/php-utf8/issues

We are really interested in feature requests and faster implementation of the functions of the package.

Important Note: when reporting bugs, please provide the following information:

PHP version, whether the iconv extension is loaded (in PHP5 it's there by default), whether the mbstring extension is loaded. The following PHP script can be used to determine this information;

    <?php
    print 'PHP Version: '.PHP_VERSION.'<br/>';
    if (extension_loaded('mbstring'))
        echo 'mbstring available<br/>';
    else
        echo 'mbstring not available<br/>';

    if (extension_loaded('iconv'))
        echo 'iconv available<br/>';
    else
        echo 'iconv not available<br/>';
    ?>

LICENSING
=========

Parts of the code in this library come from other places, under different
licenses. The authors involved have been contacted (see below). Attribution for
which code came from elsewhere can be found in the source code itself.

 - Andreas Gohr / Chris Smith of Dokuwiki. There is a fair degree of collaboration/exchange of ideas and code between [Dokuwiki's UTF-8 library][5] and phputf8. Although Dokuwiki is released under GPL, its UTF-8 library is released under LGPL, hence no conflict with phputf8

 - Henri Sivonen ([site][6]) has also given permission for his code to be released under the terms of the LGPL. He ported a Unicode / UTF-8 converter from the Mozilla codebase to PHP, which is re-used in php-utf8.

  [1]: http://www.phpwact.org/php/i18n/charsets
  [2]: http://www.phpwact.org/php/i18n/utf-8
  [3]: http://www.phpwact.org/php/i18n/utf-8
  [4]: http://hsivonen.iki.fi/producing-xml/#controlchar
  [5]: http://dev.splitbrain.org/view/darcs/dokuwiki/inc/utf8.php
  [6]: http://hsivonen.iki.fi/php-utf8/