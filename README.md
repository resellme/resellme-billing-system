<p align="center"><a href="https://resellme.co.zw" target="_blank"><img src="https://www.resellme.co.zw/img/resellme-logo.png" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Resellme

Resellme is a platform that allows resellers to start sellings hosting and domains in less than 5 minutes. For more information refer here: [Resellme](https://resellme.co.zw).

This project is a billing system resellers can use.

## Resellme Billing System

This is a free system anyone can download and customize for their preferences. 

## Installation 
1. Clone the master branch and update the `.env` with approprite details.

2. Change Directory to the cloned folder then rin this: `php artisan storage:link
`

## TODO
### Create Blade Based Pages
- Search Domain ( Public )
- Register Domain ( Requires Auth )
- Enter Contact Details ( Requires Auth )
- Enter Nameservers Details ( Requires Auth )

### Creating Controllers - Use the [PHP SDK](https://www.resellme.co.zw/docs/php-sdk)
- DomainControllers ( Handles Domains Logic )
- NameserversController ( Handles Nameserver Updates )

## Contributing

Thank you for considering contributing to this Project! Fork the develop branch and send in your pull request. Make sure tests are created and are passing.

For more information on pending tasks and progress refer to : https://trello.com/invite/b/WTsj7p4p/150c40721bbe53186ccf7db2ee270163/resellme-billing-system

## Testing
To test your codes run the following command:

```shell
php artisan test
```

## Code of Conduct

Just Be nice to others.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Privilege Nyauta via [privyreza@gmail.com](mailto:privyreza@gmail.com). All security vulnerabilities will be promptly addressed.

## License

Ths project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
