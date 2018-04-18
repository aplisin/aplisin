入门
===============

安装
------------

克隆 [`aplisin/aplisin`](https://github.com/aplisin/aplisin) 到你的服务器

    git clone git@github.com:aplisin/aplisin.git

进入项目目录执行 composer install

    cd aplisin
    composer install

添加Nginx配置：
```
server {
    set $root_dir /var/www/aplisin;

    server_name www.aplisin.ee aplisin.ee;
    root $root_dir/public;

    error_log /var/log/nginx/aplisin_error.log;
    access_log /var/log/nginx/aplisin_access.log;
	
    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ ^/(index)\.php(/|$) {
        fastcgi_pass unix:/run/php-fpm/php-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_param HTTP_X-Sendfile-Type X-Accel-Redirect;
        fastcgi_param HTTP_X-Accel-Mapping /udisk=$root_dir/app/data/udisk;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 8 128k;
    }

    location ~ ^/udisk {
        root $root_dir/app/data/;
        internal;
    }
    
    # 配置设置图片格式文件
    location ~* \.(jpg|jpeg|gif|png|ico|swf)$ {
        # 过期时间为3年
        expires 3y;
        
        # 关闭日志记录
        access_log off;

        # 关闭gzip压缩，减少CPU消耗，因为图片的压缩率不高。
        gzip off;
    }
    
    # 配置css/js文件
    location ~* \.(css|js)$ {
        access_log off;
        expires 3y;
    }

    # 禁止用户上传目录下所有.php文件的访问，提高安全性
    location ~ ^/files/.*\.(php|php5)$ {
        deny all;
    }

    location ~ \.php$ {
      return 404;
    }
}
```

composer install 之后会在根目录生成一个.env环境配置文件

.env 中的参数解析：

APP_ENV 是系统当前初始化模式

    prod 为正式环境，dev 为开发环境

DATABASE_URL 是数据库连接配置信息

    mysql://db_user:db_password@127.0.0.1:3306/db_name


JWT 系列参数：

因为系统中的token认证用了这个[`lexik/jwt-authentication-bundle`](https://packagist.org/packages/lexik/jwt-authentication-bundle)包

需要执行一下操作才能正常使用

项目根目录执行一下命令：

执行时设置密码，两次输入密码之后执行一下命令

    openssl genrsa -out config/jwt/private.pem -aes256 4096

执行时需要输入刚才设置的密码

    openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    
重要重要重要

之前设置的密码也是.env 中的 JWT_PASSPHRASE 参数的值


参数设置完了


创建数据库：

    bin/console doctrine:database:create

创建数据库表结构：

    bin/console doctrine:schema:create --force

生成测试数据：

目前会生成100个假用户

    bin/console doctrine:fixtures:load



api文档地址

    http://aplisin.ee/docs


用户注册接口地址，post请求，Content-Type 为 form-data

    http://aplisin.ee/api/register



参数

username 用户名

email 邮箱

password[first] 密码

password[second] 确认密码

返回值为 token


获取用户token地址为， post请求

    http://aplisin.ee/api/login_check

参数

username 用户名

password 密码

返回值为token