# Larakit

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/thelzf/larakit.svg)](https://packagist.org/packages/thelzf/larakit)
[![Latest Stable Version](https://img.shields.io/packagist/v/thelzf/larakit.svg)](https://packagist.org/packages/thelzf/larakit)

A collection of Brazilian-focused helpers and utilities for Laravel. Useful functions for rapid development with a focus on the Brazilian market.

## 📦 Installation

```bash
composer require thelzf/larakit
Laravel will automatically discover the ServiceProvider (Auto-discovery).
```

### 🚀 Quick Start
### Date Helpers

```php
use Larakit\Helpers\Date\Age;

// Check if older than 18 years
isOlderThan('1990-05-15', 18); // true

// Format date in Brazilian format
formatDate('2024-12-03', 'd/m/Y'); // 03/12/2024

// Human-readable date
humanDate('2024-12-01'); // 2 days ago
```

### Brazilian Masks

```php
// Apply common Brazilian masks
maskCpf('12345678909'); // 123.456.789-09
maskCnpj('12345678000195'); // 12.345.678/0001-95
maskPhone('11999999999'); // (11) 99999-9999
```

### Number Formatting
```php
// Format numbers in Brazilian format
numberFormatBr(1234.56); // 1.234,56
currencyBr(1234.56); // R$ 1.234,56
```

### Array Helpers
```php
// Array manipulation
arrayFirstKey(['a' => 1, 'b' => 2]); // 'a'
arraySortBy($array, 'name'); // Sort by specific key
```

### 📚 Complete Documentation

## Date Helpers


`isOlderThan(string $date, int $age): bool`


Checks if a birth date is greater than a specific age.

```php
isOlderThan('2006-05-15', 18); // false (not yet 18)
isOlderThan('2000-05-15', 18); // true
formatDate(string $date, string $format = 'd/m/Y'): string
```

Formats a date in Brazilian format or custom format.

```php
formatDate('2024-12-03'); // 03/12/2024
formatDate('2024-12-03', 'Y-m-d'); // 2024-12-03
```

`humanDate(string $date): string`

Returns date in human-readable format (e.g., "2 days ago", "1 month ago").

```php
humanDate('2024-12-01'); // 2 days ago
humanDate('2024-11-01'); // 1 month ago
```
### Mask Helpers

`maskCpf(string $cpf): string`

Formats CPF in Brazilian format.

```php
maskCpf('12345678909'); // 123.456.789-09
```

`maskCnpj(string $cnpj): string`

Formats CNPJ in Brazilian format.

```php
maskCnpj('12345678000195'); // 12.345.678/0001-95
```

`maskPhone(string $phone): string`

Formats Brazilian phone numbers.

```php
maskPhone('11999999999'); // (11) 99999-9999
maskPhone('1133334444'); // (11) 3333-4444
```

### Number Helpers

`numberFormatBr(float $number, int $decimals = 2): string`

Formats numbers in Brazilian format.

```php
numberFormatBr(1234.56); // 1.234,56
numberFormatBr(1234.5678, 4); // 1.234,5678
```

`currencyBr(float $value, string $symbol = 'R$'): string`

Formats monetary values in Brazilian format.

```php
currencyBr(1234.56); // R$ 1.234,56
currencyBr(1234.56, '$'); // $ 1.234,56
```

### 🔧 Manual Configuration (Optional)

If auto-discovery doesn't work, add manually to config/app.php:

```php
'providers' => [
    // ...
    Larakit\LarakitServiceProvider::class,
],
```

### 🤝 Contributing

1. Fork the Project

2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)

3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)

4. Push to the Branch (`git push origin feature/AmazingFeature`)

5. Open a Pull Request

### 📄 License

This project is licensed under the MIT License - see the [LICENSE](/LICENSE) file for details.

### 👤 Author

***Luiz Felipe de Lima Scapolan***

GitHub: [@thelzf](https://github.com/thelzf)

### ⭐ Support

If this package was useful to you, leave a ⭐ on [GitHub](https://github.com/thelzf/larakit)!

### 📦 Changelog

All notable changes will be documented in the [CHANGELOG.md](/CHANGELOG.md) file.

*Tip:* For a complete list of all available functions, check the documentation in each file in the `src/Helpers/` folder.

```markdown

## **For Packagist publishing:**

1. **Go to:** https://packagist.org/login (use GitHub login)
2. **Click:** "Submit" at the top
3. **Paste your repository URL:** `https://github.com/thelzf/larakit`
4. **Click:** "Check"
5. **If everything is OK, click:** "Submit"

Your package will be automatically updated whenever you push to GitHub if you set up the webhook.
```
