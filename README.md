# Sql To Markdown

Sql To Markdown 是一个可以将数据表的建表语句转换为 Markdown 表格的工具。

## Installation

通过 Composer 安装

```bash
$ composer global require slince/sql-to-markdown
```

## Usage

假设有一张表结构如下，将改sql保存到文件命名为 `foo.sql`

```sql
CREATE TABLE `hello_sql_to_markdown` (
  `id` int unsigned NOT NULL AUTO_INCREMENT default '0' COMMENT 'primary',
  `foo` decimal (20, 2) unsigned NOT NULL default '' COMMENT 'foo field',
  `bar` varchar (20) unsigned NOT NULL default '' COMMENT 'bar field',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=2367038934 DEFAULT CHARSET=utf8mb4 COMMENT='Demo table schema';
```

执行下面命令：

```bash
$ sql2markdown  convert  --source=foo.sql
```

即可在当前文件夹下生成 `foo.sql.md` 文件。

## 查看帮助

```bash
$ sql2markdown --help
```
## License
 
The MIT license. See [MIT](https://opensource.org/licenses/MIT)