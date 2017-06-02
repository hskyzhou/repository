# Laravel 5 Repository
Laravel5 Repository include Service, Presenter and Repository.
**Repository** is used to abstract the data layer, making application more flexible.
**Service** is used to deal business logic.
**Presenter** is used to deal View page.

## Table of Contents
- <a href="#install">Install</a>
	- <a href="#composer">Composer</a>
	- <a href="#laravel">Laravel</a>
- <a href="#command">Command</a>

## Install

### Composer
```terminal
	composer require hskyzhou/repository
```

### Laravel
edit config.php  

```php
'providers' => [
    ...
    HskyZhou\Repository\ServiceProvider::class,
],
```

Publish Configuration

```terminal
php artisan vendor:publish --tag=config --provider "HskyZhou\Repository\ServiceProvider"
```

## Command
创建实例

```php
php artisan make:entity Test
```
以上命令创建
1. migration
2. model
3. repositoryInterface
4. repositoryEloquent
5. service 业务逻辑
6. presenter 页面预处理
7. process(可选--命令会提示是否创建) 数据处理层

####创建数据处理层

```php
php artisan make:process Test
```


####创建业务逻辑

```php
php artisan make:service Test
```

####创建页面预处理
```php
php artisan make:presenter Test
```


