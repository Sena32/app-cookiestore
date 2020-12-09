<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

This is a solution created with laravel for a cookie delivery and seeks to determine with leaflet on maps, the cities with the best potential for a physical store.

## Mvp Aplication

- [Functional Requirement]

- [List all orders]
- [Filter by name, date, status, location]
- [Export the listing to csv]
- [List orders on a map]
- [Filter by name, date, status, location on the map]


- [Non-Functional Requirement]

- [PostGis and Postgress]
- [Laravel with lib LaravelPostgis]
- [Leaflet is a lib JS when work with maps]


- [Business Rule]

- [In the filter by location, you must deliver the last 6 months]
- [Highlight the locations with the highest number of requests on the map]



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

##CLIENT
    + name: string
    + telephone: string
    + addresses: adress

##ADDRESS
    + street: string
    + number: string
    + neighborhood: string
    + location : Point

##ORDERS
    + status: ENUM
    + client: Client
    + notes: string
    + products: List(products)
    + value: decimal

##PRODUCTS
    + name: string
    + price: decimal
    + amount: integer
