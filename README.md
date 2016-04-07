# Surge配置生成器

每次更新 Surge 配置文件，都需要从网上下载网上已有的配置，再手动填写自己对应服务器的配置信息，改了配置有时候还要想办法传回手机，这样非常麻烦，现在有了 Surge 配置生成器，帮你从繁琐的改配置中释放出来。

## 原理

使用 PHP 远程下载网上 自动更新的 `surge.conf` 再根据配置文件 `config.php` 中的配置替换相关字段，并返回已经更改好相应字段的配置文件。

直接使用 Surge 的 `Download Configuration from URL` 填入部署在你服务器的生成器地址即可方便的更新配置。  

## 配置

复制 `config.sample.php` 到 `config.php`，并根据你实际情况进行修改。

```php
$config = array(
  // Suerge 在线配置文件地址
  'surge' => array(
    'Abclite_ADB' => 'http://abclite.cn/Abclite_ADB.conf',
    'Abclite' => 'http://abclite.cn/Abclite.conf'
  ),
  // 你的服务器内容
  'server' => array(
    'Abclite1' => array(
      // 代理服务器列表
      'proxy' => array(
        '🇭🇰HK = custom,abclite.cn,10000,rc4-md5,abclite.cn,http://abclite.cn/SSEncrypt.module',
        '🇸🇬SG = custom,abclite.cn,10000,rc4-md5,abclite.cn,http://abclite.cn/SSEncrypt.module',
        '🇯🇵JP = custom,abclite.cn,10000,rc4-md5,abclite.cn,http://abclite.cn/SSEncrypt.module',
        '🇺🇸US = custom,abclite.cn,10000,rc4-md5,abclite.cn,http://abclite.cn/SSEncrypt.module',
        '🇰🇷KR = custom,abclite.cn,10000,rc4-md5,abclite.cn,http://abclite.cn/SSEncrypt.module'
      ),
      // 代理服务器组配置
      'group' => 'Proxy = select,🇭🇰HK,🇸🇬SG,🇯🇵JP,🇺🇸US,🇰🇷KR',
      // 请求时的验证密码（防止服务器信息泄露）
      'token' => 'myPassword'
    ),
  ),
);
```

其中 `surge` 和 `server` 可以配置多组，根据请求的 GET 参数确定返回哪个配置。

## 部署

把下载目录中的文件（`index.php`、`parse.php`）以及你修改好的 `config.php` 一起上传到一个支持 PHP 的空间，部署就完成了。

## 使用

假设你上传到服务器 `server.com` 的 `surge` 目录，配置文件如上所示，那么获取对应配置（`Abclite_ADB`）服务器（`Abclite1`）文件的网址就是：

http://server.com/surge/?config=Abclite_ADB&account=Abclite1&passwd=myPassword

将该网址填入 Surge 的 `Download Configuration from URL` 就完成了。

