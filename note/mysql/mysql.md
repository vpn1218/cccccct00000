# mysql使用

>数据库的发展阶段

> * 人工管理阶段
> * 文件系统阶段
> * 数据库系统阶段
> * 高级数据库阶段

# 数据库种类
> * 层次式数据库
> * 网络式数据库
> * 关系型数据库

# 什么是数据库
>数据库是一个长期存储在计算机内的，有组织的，有共享的，统一管理的数据集合。保管数据的仓库，以及数据管理的方法和技术

>数据库表是一系列二维数组的集合

>*字段field 属性attribute

#### 数据库系统的主要组成部分
数据库：用于存储数据的地方
数据库管理系统：用于管理数据库的软件
数据库应用程序：提高数据库处理能力所使用的管理数据的软件补充。
# SQL语言
#### SQL语言包含4部分

>     数据定义语言（DDL）：drop create alter
>     数据操作语言（DML）：insert update delete 。。
>     数据查询语言（DQL）：select
>     数据控制语言（DCL）：grant revoke commit rollback。。
#### 数据库访问接口
>     * ODBC open database connectivity 开放数据库互联
>     * JDBC java database connecivity java数据库互联
>     * ADO。net
>     * PDO php data object php访问数据库轻量级、一致性的接口。提供一个数据访问抽象层
#### mysql的优势

> * 运行速度快
> * 免费
> * 容易使用
> * 可移植
> * 丰富的接口 c c++ eiffel java perl php python ruby tcl
> * 支持查询语言
> * 安全性和连接性
#### mysql安装

下载tar包

>     # rpm -ivh MySQL-server-5.7.16.rhel5.i386.rpm
#### 更改root用户密码

>     # /usr/bin/mysqladmin -u root password 'new-passwd'
#### 删除测试数据库和匿名用户

>      # /usr/bin/mysql_secure_installation 
#### 查看旧版本

>      # rpm -qa|grep -i mysql
#### 卸载mysql

>      # rpm -ev mysql-version-4.e15_4.2
#### 查看数据库引擎
>      # show engines;

> mysql引擎 Innodb,MyISAM,Memory,Merge,Archive,Federated,CSV,BLACKHOLE.

#### Innodb存储引擎
>     *支持事务，行级锁
>     *是为处理巨大数据量的最大性能设计。
>     *Innodb存储引擎完全与mysql服务器集合
>     *支持外完整性约束
>     *ibdata1,ib_logfile0\ib_logfile1
#### MyISAM存储引擎
> * 拥有较高的插入，查询速度，不支持事务
> * 在支持大文件的文件系统和操作系统上支持大文件
> * 当把删除更新和插入操作混合使用的时候，动态尺寸的行产生更少碎片。
> * 每个myisam表最大索引数是64，可以通过编译来改变。每个索引最大列数是16
> * 最大键长1000B。可以编译改变
> * BLOB和TEXT列可以被索引。
> * null值被允许在索引的列中。这个值占每个键0-1个字节
> * 所有的数字键值以高字节优先被存储以允许一个更高的索引压缩。
> * 每表一个auto_increment列的内部处理。myisam为insert和update操作自动更新这一列，序列值被删除之后就不能再用
> * 可以把数据文件和索引文件放在不同目录
> * 每个字符列可以有不同的字符集
> * 有varchar的表可以固定或动态记录长度
> * varchar和char列可以多达64kB
#### Memory存储引擎
>Memory将表中的数据存储到内存当中。为查询和引用其他表提供快速访问

> * Memory表的每个表可以有多达32个索引。每个索引16列，以及500B的最大键长度
> * 执行hash和btree索引
> * 可以再memory长有非唯一键
> * 使用一个固定的记录长度格式
> * 不支持blob或text
> * 支持auto_increment列和对可包含null值的列的索引
> * 在索引客户端之间共享
> * 被存于内存中
> * 要释放内存 需要执行delete from 或truncate table 或drop table

**如果只有insert和select操作，可以使用archive引擎，例如写日志**

### 数据表的基本操作

---
> 创建数据表

>      # create database db1;

>      # use db1;

#### 创建数据表

>     # create table tb1(id int(11),name varchar(25) , did int(11),salary float);

#### 主键约束 要求主键列的数据唯一，并且不允许为空。
        主键分为单字段主键和多字段联合主键

> 1.字段名 数据类型 primary key [默认值]
```
create table tb2(
    id int(10) primary key,
    name varchar(25),
    deptid int(11),
    salary float
);
```
> 2.在定义完所有列之后指定主键 [constraint <约束名>] primary key [字段名]
```
create table tb3(
    id int(11),
    name varchar(25),
    deptid int(11),
    salary float,
    primary key(id)
);
```
> 3. 多字段联合主键

        假设没有主键id，为了确定唯一的一个员工，可以用name，deptid联合做主键
```
create table tb4(
    name varchar(25),
    deptid int(11),
    salary float,
    primary key(name ,deptid)
);
```
#### 使用外键约束
>     创建外键约束的语法规则；

> [constraint <外键名>] foreign key 字段名1[字段名2，...]

> references <主表名> 主键列1,[主键列2.。。]

>      外键名为定义的外键约束的名称，一个表中不能有相同名称的外键。

>创建数据表 部门表 tb_d1
```
create table tb_d1(
    id int(11) primary key,
    name varchar(22) not null,
    location varchar(50)
);
```
> 定义员工表
```
create table tb_e1(
    id int(11) primary key,
    name varchar(25),
    deptid int(11),
    salary float,
constraint fk_emp_dep1 foreign key(deptid) references tb_d1(id)
);
```
#### 非空约束
>  字段名 数据类型 not null

#### 唯一性约束 unique constraint 
> 字段名 数据类型 unique

> constraint <约束名> unique(name)
```
create table tb_e1(
    id int(11) primary key,
    name varchar(22),
    location varchar(50),
    constraint sth unique(name)
);
```
#### 默认约束
> 字段名 数据类型 default 默认值

#### 设置表属性自动增加
> 字段名 数据类型 auto_increment 

### 查看数据表结构
>     # descibe table_name;
>     # desc table_name;

#### 查看详细结构语句
>     # show create table table_name\G;

### 修改数据表

##### 修改表名
>     # alter table table_name_o rename table_name_n;

#### 修改字段数据类型
>     # alter table t_name modify field_name 数据类型

#### 修改字段名称
>     # alter table t_name change field_name_o field_name_n ntype;

#### 添加字段
>     # alter table t_name add field_name_n type [after field_name_c| first];
>     # alter table t_name add id2 int(10);
>     # alter table t_name add name2 varchar(25) not null;
>     # alter table t_name add col2 int(10) first;
>     # alter table t_name add col3 int(11) after name2;

#### 删除字段
>     # alter table t_name drop field_name;

#### 修改字段排列位置
>     # alter table t_name modify field_name1 type first|after field_name2

#### 更改表的存储引擎
>     # alter table t_name engine=MyISAM[Innodb,..];

#### 删除表的外键约束
>     # alter table t_name drop foreign key <foreign_key_name>;

### 删除数据表
>     # drop table [if exists] t1,t2,t3......;

# 数据类型

### 整数类型
|类型名称|说明|存储需求|有符号|无符号|
|-------|------|-----|----|---    |
|tinyint|很小的整数|1个字节|-128~127|0~255|
|smallint|小的整数|2个字节|-32768~32767|0~655535|
|mediumint|中等整型|3个字节|-8388608~8388607|0~16777215|
|int|普通大小整数|4个字节|-2147483648~2147483647|0~4294967295|
|bigint|大整数|8个字节|-2^63~2^63|2^64|

### 浮点类型和定点类型

|类型名称|说明|存储需求|
|----|----|----|
|float|单精度|4个字节|
|double|双精度浮点数|8个字节|
|decimal(m,d),dec|定点数|M+2个字节|

### 时间日期类型

|类型名称   |日期格式   |日期范围   |存储需求   |
|------    |-----       |----       |-----  |
|year       |YYYY       |1901-2155  |1字节    |
|time       |HH:MM:SS|-838:59:59~838:59:59|3字节|
|date       |YYYY-MM-DD|1000-01-01~9999-12-3|3字节|
|datetime   |YYYY-MM-DD HH:MM:SS|1000-01-01 00:00:00~ 9999-12-31 23:59:59|8字节|
|timestamp  |YYYY-MM-DD HH:MM:SS|1970-01-01 00:00:01 UTC~2038-01-19 03:14:07 UTC|4字节|

#### year类型
>     1.存储时只占一个字节；范围1901-2155
>     2.四位字符串或数字 为1901-2155
>     3.以2位字符串表示的year 范围为‘00’-‘99’ ‘00’-‘69’转换为2000-2069 ‘70’-‘99’转换为1970-1999
>     4.以2位数字表示的year 范围1-99 1-69转换为2001-2069 70-99转换为1970-1999 0转换为0000

#### time类型
>     1.存储站3个字节
>     2."D HH:MM:SS" D表示日 可以取0-34之间的值 插入数据库时 D被转换为小时保存 格式D*24+HH
>     3.没有分隔符的 101112 理解为10:11:12  但109712是不合法的
>     4.如果没有冒号 mysql假定最右两位是秒   如果有冒号被视为当天的时间 11:12   11:12:00

#### date类型
>     1.以YYYY-MM-DD或YYYYMMDD取值范围 1000-01-01~9999-12-3 
>     2.以YY-MM-DD或YYMMDD  00-69=> 2000-2069  70-99=> 1970-1999
>     3.使用CURRENT_DATE或者NOW() 插入当前系统日期。
>     4.mysql允许不严格语法  任何标点符号都可以用作日期之间的间隔符。格式

#### datetime类型
>     1.存储需要8个字节
>     2.以数字或字符串  YYYY-MM-DD HH：MM：SS  取值范围1000-01-01 00：00:00 ~9999-12-3 23:59:59
>     3.YY-MM-DD HH:MM:SS  00-69 2000-2069 70-99 1970-1999;

#### timestamp类型
>     1.timestamp显示格式和datetime相同
>     2.timestamp和datetime除了存储字节和支持的范围不同还有一个 datetime按实际输入的格式存储。timestamp是以UTC格式保存


### 字符串类型 文本字符串和二进制字符串

|类型名称   |说明         |存储需求           |
|---------|--------------|  --------------- |
|char(M)  |固定长度非二进制字符串|M字节，1<=M<=255|
|varchar(M)|变长非二进制字符串|L+1字节，L<=M 1<=M<=655535|
|tinytext|非常小的非二进制字符串|L+1字节 L<2^8|
|text|小的非二进制字符串|L+2字节，L<2^16|
|mediumtext|中等大小的非二进制字符串|L+3字节，L<2^24|
|longtext|大的非二进制字符串|L+4字节，L<2^32|
|enum|枚举类型，只能有一个枚举字符串值|1或2个字节，取决于枚举值的数目（最大65535）|
|set|一个设置，字符串对象可以有0个或多个set成员|1,2,3,4或8个字节，取决于集合成员的数量（最多64个成员）|

#### char和varchar类型
>     char为定长字符串，定义时指定字符串列长。当保存在右侧填充空格达到指定的长度
>     varchar（M）是长度可变的字符串，m表示最大列长度。varchar最大长度由最长的行的大小和使用的字符集决定。实际占用的空间为字符串的实际长度加1.

#### char(4)和varchar(4)的存储区别

|插入值|char（4）|存储需求|varchar（4）|存储需求|
|-----|-----|------|-----|-----|
|‘’     |‘    ’|4字节|‘’|1字节|
|‘ab‘   |’ab  ‘|4字节|’ab‘|3字节|
|’abc‘  |'abc '|4字节|'abc'|4字节|
|'abcd' |'abcd'|4字节|'abcd'|5字节|
|'abcdef'|'abcd'|4字节|'abcd'|5字节|

#### enum类型
>字段名 enum('val1','val2','val3',...'值n');
>enum字符串是一个字符串对象，其值为表创建时在列规定中枚举的一列值。enum在内部用整数表示，每个枚举值均有一个索引值，列表值所允许的成员值从1开始编号，枚举最多有65535个元素。

#### set类型
>set是一个字符串对象，可以有0或多个值，set列最多可以有64个成员，其值是表创建时规定的一列值。

>set('val1','val2','val3',....'valn');

### 二进制字符串类型

|类型名称|说明|存储需求|
|------|------|-------|
|bit（m）|位字段类型|大约（m+7）/8个字节|
|binary（m）|固定长度二进制字符串|M个字节|
|varbinary（m）|可变长度二进制字符串|m+1个字节|
|tinyblob（m）|非常小的blob|L+1个字节 L<2^8|
|blob(m)|小blob|L+2字节，L<2^16|
|mediumblob(m)|中等大小的blob|L+3字节，L<2^24|
|longblob（m）|非常大的blob|L+4字节，L<2^32|



### 运算符
> #### 运算符四大类：算术运算符，比较运算符，逻辑运算符，位操作运算符；

#### 算术运算符
>     mysql> create table t4 (num int);
>     mysql> insert into t4 value(64);
>     mysql> select num,num+1,num-3,num+5-3,num+36.5 from t4;
>     mysql> select num,num*2,num/2,num*3/2 from t4;

#### 比较运算符
> 比较运算符的结果总是1,0或者null。比较运算符经常在select的查询条件子句中使用。

> #### 等于运算符(=) 用来判断数字，字符串和表达式是否相等。相等返回1，否则返回0


>     1.若有一个或2个参数为null，则比较运算的结果是null；
>     2.若两个参数都是字符串，则按照字符串比较；
>     3.若两个参数均为整数，则按照整数进行比较；
>     4.若一个字符串和数字进行相等比较，则mysql可以自动将字符串转换为数字。

> #### 安全等于运算符(<=>)

>     <=>这个操作符和=操作符执行相同的比较，不过<=>可以判断null值，两个均为null时，返回1而不是null。一个操作数是null，返回值为0而不为null；

> #### 不等于运算符(<>或者!=)


>     '<>'或者'!=' 用于判断数字，字符串，表达式不相等的判断。不相等返回1，反则返回0；
>  ##### '<>'或者'!='这俩运算符不能判断空值null 

> #### 小于或等于运算符(<=),小于运算符(<),大于或等于(>=),大于(>),不能判断空值null。


> #### is null(isnull),is not null 检测是否是null   

> #### between and 运算符

> #### least 运算符  返回最小值

> #### greatest(val1,val2,val3,...valn); 返回最大值；

> #### in ,not in 

> #### like

>     1.'%'，匹配任何数目的字符，甚至包括零字符。
>     2.'_' 只能匹配一个字符。


#### 逻辑运算符

|运算符|作用||
|---|-----|---|
|not或者!|逻辑非|操作数为0，所得值为1。操作数非0，所得值为0；操作数为null。返回值是null|
|and或&&|逻辑与|所有操作数均为非零值，并且不为null时，计算所得结果为1；当一个或者多个操作数为0时，所得结果是0，其余返回null|
|or或\|\| |逻辑或|当两个操作数都是非null值，且任意一个操作数非0，其结果是1，否则为0。当有一个操作数为null，另一个操作数非0，返回1，否则返回null，两个操作数皆为null，返回null|
|xor |逻辑异或|当任意一个操作数为null，返回null；两个操作数都是非0或者都是0，返回0；一个0，一个非0，返回1；|




# mysql函数

### 数学函数

>     abs(x) 绝对值函数
>     pi()圆周率函数
>     sqrt(x)平方根函数
>     mod(x)求余函数
>     ceil(x),ceiling(x),floor(x);获取整数
>     rand(),rand(x) 产生随机数，带参数的产生固定的随机数；
>     round(x),round(x,y)和truncate(x,y),四舍五入和截取；
>     sign(x)符号函数，x的值为负，0，或正 依次为-1,0,1；
>     pow(x,y),power(x,y)和exp(x)幂函数
>     log(x) e为底的对数   log10(x),底数为10的x的对数
>     radians(x)和degrees(x)角度和弧度互相转换函数。
>     sin(x)和asin(x);正弦和反正弦函数 x为弧度值
>     cos(x)和acos(x)余弦和反余弦
>     tan(x),atan(x),cot(x);正切，反正切，余切

### 字符串函数







