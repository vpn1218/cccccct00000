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





