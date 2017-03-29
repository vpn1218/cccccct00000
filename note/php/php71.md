#### 安装php7.1.0rc6
##### 最小化安装php7.1.0rc6
    > ./configure --prefix=/usr/local/php710 --enable-fpm

---
>     默认安装的模块 cgi-fcgi,Core,ctype,date,dom,fileinfo,filter,hash,iconv,json,libxml,pcre,PDO,pdo_sqlite,Phar,posix,Reflection,session,SimpleXML,SPL,sqlite3,standard,tokenizer,xml,xmlreader,xmlwriter

####详细安装

>     ./configure  \
>     --prefix=/usr/local/php710 \
>     --enable-fpm \
>     --with-config-file-path=/usr/local/php710/conf \
>     --with-config-file-scan-dir=/usr/local/php710/conf.d \
>     --with-openssl \
>     --with-zlib \
>     --enable-bcmath \
>     --with-bz2 \
>     --enable-calendar \
>     --with-curl \
>     --with-enchant \
>     --enable-exif \
>     --enable-ftp \
>     --with-gd \
>     --with-jpeg-dir \
>     --with-freetype-dir \
>     --enable-gd-native-ttf \
>     --with-png-dir \
>     --with-xpm-dir \
>     --enable-gd-jis-conv \
>     --with-libdir=lib64 \
>     --with-mhash \
>     --with-imap \
>     --with-kerberos \
>     --with-imap-ssl \
>     --enable-mbstring \
>     --with-mcrypt \
>     --with-zlib-dir \
>     --enable-shmop \
>     --enable-soap \
>     --enable-sockets \
>     --enable-wddx \
>     --with-xsl \
>     --enable-zip \
>     --enable-mysqlnd \
>     --enable-fast-install \
>     --with-onig \
>     --enable-sysvmsg \
>     --enable-sysvsem \
>     --enable-sysvshm \
>     --with-tidy \
>     --with-pdo-mysql=mysqlnd \
>     --enable-embedded-mysqli \
>     --with-mysqli=mysqlnd \
>     --enable-dtrace \
>     --enable-opcache \
>     --with-fpm-acl \
>     --enable-phpdbg \
>     --enable-phpdbg-webhelper \
>     --with-system-ciphers \
>     --with-webp-dir \
>     --with-pcre-jit \



>     --with-readline \
>     --with-pdo-firebird \
>     --with-interbase \





> yum -y install systemtap-sdt-devel libc-client-devel libmcrypt-devel libtidy-devel libacl-devel


```
git clone https://github.com/Jan-E/php7-ffmpeg ffmpeg 
git clone https://github.com/krakjoe/ustring 
git clone https://github.com/nikic/php-ast ast 
git clone -b php7 https://github.com/phpredis/phpredis redis 
git clone -b php7 https://github.com/msgpack/msgpack-php msgpack 
git clone -b php7 https://github.com/johmue/php_excel excel 
git clone -b PHP7 https://github.com/reeze/php-leveldb leveldb 
git clone -b php7 https://github.com/Sean-Der/igbinary igbinary 
git clone https://github.com/krakjoe/pthreads 
git clone https://github.com/krakjoe/strict 
svn co http://svn.php.net/repository/pecl/wincache/branches/WinCache_PHP7 wincache 
git clone -b php7 https://github.com/laruence/taint 
git clone https://github.com/xdebug/xdebug 
git clone https://github.com/websupport-sk/pecl-memcache memcache 
git clone https://github.com/krakjoe/apcu 
git clone https://github.com/krakjoe/apcu-bc 
git clone -b feature/php7 https://github.com/sqmk/pecl-jsmin.git jsmin 
git clone -b seven git://git.php.net/pecl/tools/stomp 
git clone https://github.com/php/pecl-networking-ssh2 ssh2 
git clone https://github.com/php/pecl-mail-mailparse.git mailparse 
git clone https://github.com/php/pecl-text-xdiff.git xdiff 
git clone https://github.com/Sean-Der/pecl-math-stats.git stats 
git clone https://github.com/Sean-Der/pecl-web_services-oauth.git oauth 
git clone https://github.com/php/pecl-search_engine-solr.git solr 
git clone -b php7 https://github.com/php/pecl-file_formats-haru.git haru 
svn co http://svn.php.net/repository/pecl/dbase/trunk dbase 
git clone https://github.com/m6w6/ext-propro.git propro 
git clone https://github.com/m6w6/ext-raphf.git raphf 
git clone https://github.com/m6w6/ext-http.git http 
git clone https://github.com/esminis/php_pecl_judy judy 
git clone https://github.com/esminis/php_pecl_spl_types spl_types 
git clone https://github.com/esminis/php_pecl_id3 id3 
git clone -b PhpNg https://github.com/esminis/php_pecl_rar.git rar 
git clone https://github.com/esminis/php_pecl_bbcode bbcode 
git clone https://github.com/esminis/php_pecl_rpmreader rpmreader 
git clone https://github.com/phpv8/v8js.git
```