<?php
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
        // 请求时的验证密码（防止服务器泄露）
        'passwd' => 'myPassword'
      ),
    ),
  );
?>