###编译安装php5.3.29
>最少项目： ./configure --prefix=/usr/local/php5329  --enable-fpm 
----- 
  默认安装模块  core,ctype,date,dom,ereg,fileinfo,filter,hash,iconv,json,libxml,pcre,pdo,pdo_sql_slite,phar,posix,Reflection,session,simplexml,spl,sqlite,sqlite3,standard,tokenizer,xml,xmlreader,xmlwriter.
  
> yum -y install bzip2-devel libcurl-devel enchant-devel t1lib-devel gmp-devel uw-imap-devel.x86_64  firebird-devel libicu-devel openldap-devel libmcrypt-devel unixODBC-devel  postgresql-devel
  
./configure --prefix=/usr/local/php5329 --enable-fpm --with-config-file-path=/usr/local/php5329/conf  --with-config-file-scan-dir=/usr/local/php5329/conf.d   --with-openssl  --with-zlib --enable-bcmath --with-bz2 --enable-calendar --with-curl --with-curlwrappers --enable-dba --with-enchant --enable-exif --enable-ftp --with-gd --with-jpeg-dir --with-freetype-dir --with-t1lib --enable-gd-native-ttf --with-png-dir --with-xpm-dir  --enable-gd-jis-conv --with-libdir=lib64 --with-gettext --with-gmp --with-mhash --with-imap --with-kerberos --with-imap-ssl --with-interbase --enable-intl --with-icu-dir=/usr --enable-mbstring --with-ldap --with-ldap-sasl --with-libmbfl --with-onig --with-mcrypt  --with-sapdb   --with-solid --with-ibm-db2 --with-empress --with-empress-bcs --with-birdstep  --with-unixODBC=/usr 


####添加命令行参数 ：
修改/etc/profile文件使其永久性生效，并对所有系统用户生效，在文件末尾加上如下两行代码
PATH=$PATH:/usr/local/webserver/php/bin:/usr/local/webserver/mysql/bin
export PATH

最后：执行 命令source /etc/profile或 执行点命令 ./profile使其修改生效，执行完可通过echo $PATH命令查看是否添加成功




