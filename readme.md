# What is this?

An application example using the [Flux](https://facebook.github.io/flux/) library for [Vue](https://vuejs.org/), [Vuex](https://vuex.vuejs.org/) for the frontend and [Symfony4](https://symfony.com/) for the backend.

## Prerequisites

- PHP 7.2+ with [php-v8js](https://github.com/phpv8/v8js) module installed
  - [brew](https://brew.sh/) gives an easy way to do this on OSX with `brew install php71-v8js`
- Composer 1.5.x
- Node 8.x
- Npm

## Getting Started

1) Download the repository and execute the next command in console:
2) `composer update` to get PHP dependencies
3) `npm install` to get JS dependencies
4) `npm run dev` to build JS files (or `npm run watch` for interactive watch)
5) `php bin/console server:run` to start a PHP server on `127.0.0.1:8000`


## Execution Guides

Execution guide in the following files:
* [readme_backend.md](./readme_backend.md)
* [readme_frontend.md](./readme_frontend.md)