# Laravel Planfact

[![Packagist](https://img.shields.io/packagist/v/jsphpcoder/laravel-planfact)](https://packagist.org/packages/jsphpcoder/laravel-planfact)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-blue)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-9.x%20%7C%2010.x-red)](https://laravel.com/)

**Laravel Planfact** — это пакет для работы с API [Planfact.io](https://planfact.io), который позволяет интегрировать ваш Laravel-проект с сервисом бухгалтерского учета.

## 📦 Установка

Установите пакет через Composer:

```sh
composer require jsphpcoder/laravel-planfact
```

## ⚙️ Настройка

1. Опубликуйте конфигурацию:

   ```sh
   php artisan vendor:publish --provider="JSPHPCoder\LaravelPlanfact\Providers\PlanfactServiceProvider"
   ```

2. В файле `.env` укажите API-ключ:

   ```ini
   PLANFACT_API_KEY=your_api_key_here
   ```

## 📖 Документация

Полная документация доступна на [Planfact API](https://apidoc.planfact.io/).

## 🤝 Поддержка

Если у вас возникли вопросы или проблемы, создайте issue в [GitHub Issues](https://github.com/JSPHPCoder/laravel-planfact/issues).

## 📜 Лицензия

Этот проект распространяется под лицензией **MIT**.

