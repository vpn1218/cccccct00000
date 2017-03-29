#### 安装php7.0.9
##### 最小化安装php7.0.9
    >./configure --prefix=/usr/local/php709 --enable-fpm
---
>     默认安装的模块 cgi-fcg,Core,ctype,date,dom,fileinfo,filter,hash,iconv,json,libxml,pcre,PDO,pdo_sqlite,Phar,posix,Reflection,session,SimpleXML,SPL,sqlite3,standard,tokenizer,xml,xmlreader,xmlwriter,Additional Modules,Environment


> yum -y install libwebp-devel

#####详细安装
>     ./configure  \
>     --prefix=/usr/local/php709 \
>     --enable-fpm \
>     --with-config-file-path=/usr/local/php709/conf \
>     --with-config-file-scan-dir=/usr/local/php709/conf.d \
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
>     --with-t1lib \
>     --enable-gd-native-ttf \
>     --with-png-dir \
>     --with-xpm-dir \
>     --enable-gd-jis-conv \
>     --with-libdir=lib64 \
>     --with-gettext\
>     --with-gmp \
>     --with-mhash \
>     --with-imap \
>     --with-kerberos \
>     --with-imap-ssl \
>     --with-interbase \
>     --enable-mbstring \
>     --with-mcrypt \
>     --with-pdo-firebird \
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
>     --with-readline \
>     --with-pdo-mysql=mysqlnd \
>     --enable-embedded-mysqli \
>     --with-mysqli=mysqlnd \
>     --with-mysql=mysqlnd \
>     --with-mssql \
>     --enable-dtrace \
>     --with-vpx-dir \
>     --enable-opcache \
>     --with-fpm-acl \
>     --enable-phpdbg \
>     --enable-phpdbg-webhelper \
>     --with-system-ciphers \
>     --with-webp-dir \

>NOTE configure: WARNING: unrecognized options: --with-t1lib, --with-gettext--with-gmp, --with-mysql, --with-mssql, --with-vpx-dir


