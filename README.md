# Pickolor2 - Online color picker and color palettes creator

## Pickolor is a highly intuitive color picker designed especialy for developers. Discover it's magical powers and sign up now...

## Installation
```bash
git clone https://github.com/gtluszcz/pickolor2.git
cd pickolor2
composer install
cp .env.example .env
php artisan key:generate
# Fill MySQL or PostgreSQL database credentials in .env file
php artisan migrate
php artisan serve --host=localhost --port=8080
# Navigate to http://localhost:8080
```

## Demo
The demo is previewable at https://pickolor.herokuapp.com

## Overview
### Technologies:
- **Back-end**
    - **PHP** — All of the back-end code is written in PHP – version is 7.1 (current stable).
    - **Laravel 5.5** — I have decided to use a Laravel web framework, because it is [the most popular framework for PHP at the moment](https://trends.google.com/trends/explore?q=Laravel,Symfony,CakePHP,Codeigniter,Yii). It is also the greatest.
    - **PostgreSQL** — Used PostgreSQL for Heroku deployment.
- **Front-end**
    - **JavaScript / ES6** — At the front-end I have used simple JavaScript in the ECMA Script 6 standard.
    - **JQuery** - for interactive elemnts on the site.
    - **Sass** — As a compilation phase for my CSS I have used Sass for use of variables, nesting and more.
    - **Bootstrap** — Since Laravel ships with Bootstrap out of the box, I have decided to go with it as a main, industrial visual language.
    - **Webpack** — Used as a compilator for all of my front-end assets I have used Webpack and Laravel Mix. That allows for backward-compatibility compilation of assets, minification, uglification and prefixing of CSS.

### Features
- Visitor:
    - Can sign up,
    - Can log in,
    - Can create new colors,
    - Can create new gradients,
    - Can create new plattes,
    - Can preview already existing plattes,
    - Can preview already existing colors,
    - Can preview comments,
    - Can sort colors, palettes.
- User in addition:
    - Can save palette,
    - Can save color,
    - Can add palettes to favourites,
    - Can add colors to favourites,
    - Can delete his palette,
    - Can modify his palettes,
    - Can copy palettes of other players,
    - Can comment palettes and colors,
    - Can chat with other users,
