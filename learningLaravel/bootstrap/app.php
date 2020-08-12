<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

// 实例化 Laravel 服务容器，并调用其构造函数，执行初始化任务
/**
 * dirname() 函数返回路径中的目录名称部分
*/
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
/**
 * 注：
 * 在进行 new Illuminate\Foundation\Application 时，Application 类并没有加载到 PHP 内存中，
 * 这个时候，就用到 Composer 自动加载原理 里面讲的 loadClass 方法了，PHP 会首先执行 loadClass 方法，
 * 获取 Application 类所在绝对路径，通过 include 语句，将 Application 注入到内存。
 * 且在 include 过程中，Application 继承的父类，父类继承祖类，其中实现的接口类，会依次循环调用 loadClass 方法，
 * 直至所有用到的类全部注入 PHP 内存中，方能 new Illuminate\Foundation\Application。这里讲明，以后遇到 new 一个类不再说明
*/


/*
|--------------------------------------------------------------------------
| Bind Important Interfaces  绑定重要接口
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
| 接下来，我们需要将一些重要的接口绑定到容器中，因此
  我们将能够在需要时解决它们。 内核服务于
  从Web和CLI向此应用程序的传入请求
*/
//把没有做好的 `App\Http\Kernel` 类的对象，放在 bindings 属性中， `Illuminate\Contracts\Http\Kernel` 这串字符就是标记
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

// 把没有做好的 `App\Console\Kernel` 类的对象，放在 bindings 属性中， `Illuminate\Contracts\Console\Kernel` 这串字符就是标记
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// 把没有做好的 `App\Exceptions\Handler` 类的对象，放在 bindings 属性中， `Illuminate\Contracts\Debug\ExceptionHandler` 这串字符就是标记
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

//返回初始化完成的 Laravel 服务容器
return $app;
