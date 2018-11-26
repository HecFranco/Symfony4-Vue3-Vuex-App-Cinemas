# Symfony 4 - App Cinemas (Backend)

We will make the backend of the application with the framework Symfony. We will have two entities, **User** and **Task**. Access to the login will be via `Jwt`

### Summary steps:
1. [Project Creation](#1project-creation)
2. [Database Configuration](#2database-configuration)
3. [Entities](#3entities)
4. [Routing](#4routing)
5. [Installing Vue, SASS and bootstrap 4 using WebPackEncore](#5installing-vue-sass-and-bootstrap-4-using-webpackencore)
    1. [Installing Twig](#51installing-twig)
    2. [Installing Vue using WebPackEncore](#52installing-vue-using-webpackencore)
    3. [Installing SASS and bootstrap 4](#53installing-sass-and-bootstrap-4)
6. [Creating a JSON Response](#6creating-a-json-response)
7. [Login JWT](#7login-jwt)
8. [Other Requests to the Api](#8other-requests-to-the-api)

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton symfony`

---------------------------------------------------------------------------------------

## Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Apache-Pack Component](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules), `composer require symfony/apache-pack`
* [Var-dumper Component](https://symfony.com/doc/current/components/var_dumper.html), `composer require symfony/var-dumper`. **Note** If using it inside a Symfony application, make sure that the DebugBundle has been installed (or run `composer require symfony/debug-bundle` to install it).
* [Debug-Bundle Component](https://symfony.com/doc/current/components/debug.html), `composer require debug --dev`
* [The Config Component](https://symfony.com/doc/current/components/config.html), `composer require symfony/config`.

* `composer require dependency-injection`

* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Twig Extension Component](https://symfony.com/doc/current/templating/twig_extension.html), `composer require twig/extensions`
* [Asset component](https://symfony.com/doc/current/components/asset.html), `composer require symfony/asset`
* [Knplabs/knp-paginator-bundle](https://packagist.org/packages/knplabs/knp-paginator-bundle), `composer require knplabs/knp-paginator-bundle`

* [Doctrine Component](https://symfony.com/doc/current/doctrine.html), `composer require doctrine`
* [Security Component](https://symfony.com/doc/current/components/security.html), `composer require security`
* [Validator Component](https://symfony.com/doc/current/components/validator.html), `composer require validator`
* [Form Componente](https://symfony.com/doc/current/forms.html), `composer require form`

* [Firebase/php-jwt](https://packagist.org/packages/firebase/php-jwt), `composer require firebase/php-jwt`
* [The HttpFoundation Component](https://symfony.com/doc/current/components/http_foundation.html), `composer require symfony/http-foundation`.
* [The Serializer Component](https://symfony.com/doc/current/components/serializer.html#using-callbacks-to-serialize-properties-with-object-instances), `composer require symfony/serializer`

* [Mailer Component](https://symfony.com/doc/current/email.html), `composer require mailer`
* [Check Requirements for Running Symfony Component](https://symfony.com/doc/current/reference/requirements.html), `composer require symfony/requirements-checker` 

### Summary Console command`s to be used

* `php bin/console server:run`
* `php bin/console doctrine:database:create`
* `php bin/console doctrine:schema:update --force`
* `php bin/console doctrine:migrations:diff`
* `php bin/console doctrine:migrations:migrate`
* `php bin/console make:controller Default`

# Symfony 4 - Task Manager (Backend)

--------------------------------------------------------------------------------------------

## 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton symfony
```

2. In the next step we will access the project folder using:

```bash
cd symfony
```

3. It is necessary to install the **server component**, to use our **Server Local**, through the console command:

```bash
composer require server --dev
```

4. Now, we are going to install de **profiler component** to can use the debug toolbar of symfony:

```bash
composer require --dev profiler
```

5. Now, you will be able to view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

6. Access to [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to view the result.

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 2.Database Configuration

--------------------------------------------------------------------------------------------

1. We will installed **Doctrine Component** to manage the database of project using the command:

```bash
composer require doctrine
```

2. To configurate the database connection, we will modified the environment variable called `DATABASE_URL`. For then, we you can find and customize this inside [.env](.env):

_[.env](.env)_
```diff
# .env
###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
++ DATABASE_URL=mysql://root:@127.0.0.1:3306/app-cinemas
++ # db_user: root
++ # db_password: 
++ # db_name: app-cinemas
# to use sqlite:
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"
###< doctrine/doctrine-bundle ###
```

(Source: [https://symfony.com/doc/current/doctrine.html#configuring-the-database](https://symfony.com/doc/current/doctrine.html#configuring-the-database))

3. In console lunch the command `php bin/console doctrine:database:create`. Now you have your data base created in your local server.

4. If you want to use XML instead of `yaml`, add `type: yml` and `dir: '%kernel.project_dir%/config/doctrine'` to the entity mappings in your [config/packages/doctrine.yaml](config/packages/doctrine.yaml) file.

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yml
doctrine:
    # ...
    orm:
        # ...
        mappings:
            App:
                is_bundle: false
                # type: annotation
                type: yml
                # dir: '%kernel.project_dir%/src/Entity'
                dir: '%kernel.project_dir%/config/doctrine'
                prefix: 'App\Entity'
                alias: App
```

(Source: [https://symfony.com/doc/current/doctrine.html](https://symfony.com/doc/current/doctrine.html))

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 3.Entities

--------------------------------------------------------------------------------------------

1. Now, We can generate our user and task entities.

### User Entity

_[config/doctrine/User.orm.yml](./config/doctrine/User.orm.yml)_
```yml
App\Entity\Users:
    type: entity
    #repositoryClass: App\Repository\UserRepository      
    table: users
    id:
        id:
            type: integer
            nullable: false
            options:
                unsigned: false
            id: true
            generator:
                strategy: IDENTITY
    fields:
        role:
            type: json_array
            nullable: false
            length: null
            options:
                fixed: false         
        username:
            type: string
            nullable: true
            length: 80
            options:
                fixed: false
        name:
            type: string
            nullable: true
            length: 180
            options:
                fixed: false
        surname:
            type: string
            nullable: true
            length: 255
            options:
                fixed: false                
        email:
            type: string
            nullable: false
            length: 254
            options:
                fixed: false
        plainPassword:
            type: text
            length: 4096
            column: plain_password
        password:
            type: string
            length: 64
        isActive:
            type: boolean
            nullable: false
            options:
                default: '0'
            column: is_active
        createdAt:
            type: datetime
            nullable: false
            column: created_at
        updatedAt:
            type: datetime
            nullable: false
            column: updated_at
    lifecycleCallbacks: {  }
```

> We need use the **security-bundle** of Symfony to extends the class user (`class Users implements UserInterface {}`), for it execute the command `composer require symfony/security-bundle`.

_[src/Entity/User.php](./src/Entity/User.php)_
```php
<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

class Users implements UserInterface {
    private $id;
		public function getId() { return $this->id; } 
    private $username;
    public function getUsername() { return $this->username; }
    public function setUsername($username=null) { $this->username = $username; }    
    private $name;    
		public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; } 		 	
		private $surname;
    public function setSurname($surname) { $this->surname = $surname; return $this; }
    public function getSurname() { return $this->surname; }		
		private $email;
    public function setEmail($email) { $this->email = $email; return $this; }
    public function getEmail() { return $this->email; }		
    private $plainPassword;
    public function getPlainPassword() { return $this->plainPassword; }
    public function setPlainPassword($password) { $this->plainPassword = $password; }    
    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     */
    private $password;
    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
		private $isActive;
    public function getIsActive() { return $this->isActive; }
    public function setIsActive($isActive) { $this->isActive = $isActive; }		
    public function __construct()     {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
		public function getCreatedAt() { return $this->createdAt; }
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }    
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
			// The bcrypt and argon2i algorithms don't require a separate salt.
			// You *may* need a real salt if you choose a different encoder.
			return null;
		}
		// other methods, including security methods like getRoles()
		private $role;
    public function setRole($role) { $this->role = $role; /*return $this;*/ }
		public function getRole() { return $this->role; }
		public function getRoles(){ return array('ROLE_USER','ROLE ADMIN'); }
		// ... and eraseCredentials()
		public function eraseCredentials() { }
		/** @see \Serializable::serialize() */
		public function serialize() {
				return serialize(array(
						$this->id,
						$this->username,
						$this->password,
						$this->role,
						// see section on salt below
						// $this->salt,
				));
		}
		public function unserialize($serialized) {
				list (
						$this->id,
						$this->username,
						$this->password,
						// see section on salt below
						// $this->salt
				) = unserialize($serialized);
		} 		
}
```

> We can load the database in ([/symfony/bbdd/bbdd.sql](./bbdd/bbdd.sql)) using phmyadmin and enter a first example user.

> To read the rest of the project entities access the folders [/symfony/src/Entity/](./src/Entity/) and [/symfony/config/doctrine/](./config/doctrine/).

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 4.Routing

--------------------------------------------------------------------------------------------

1. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](./config/routes.yaml)_
```yml
#index:
#    path: /
#    controller: App\Controller\DefaultController::index
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
routing_distributed:
    # loads routes from the given routing file stored in some bundle
    resource: '../src/Resources/config/routing.yaml' 
    type: yaml
```

2. Next step is defined our folder with routing files of our app in [src/Resources/config/routing.yml](./src/Resources/config/routing.yml)

_[src/Resources/config/routing.yml](./src/Resources/config/routing.yml)_
```yml
app_routing_folder:
    # loads routes from the given routing file stored in some bundle
    prefix: '/api/v1'
    resource: 'routing/' 
    type: directory
```

_[src/Resources/config/routing/default.yml](./src/Resources/config/routing/default.yml)_
```yml
default_pruebas:
    path: /test
    controller: App\Controller\DefaultController::test
    #methods:   [POST] 
```

3. Now we can test the generated entities and the router. For this we generate a first controller [/src/Controller/DefaultController.php](./src/Controller/AuthenticationController.php) with a method `tests()`.

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```php
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Users;

class DefaultController extends Controller {
  public function test (request $request) {
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
    $userList = $user_repo->findAll();
    return $this->render('base.html.twig', [
      'base_dir' =>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      'user'=>$userList
    ]);
  }
}
```

4. If we run `php bin/console server:run` and access [http://127.0.0.1:8000/api/v1/test](http://127.0.0.1:8000/api/v1/test) we can see the existing entity.

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 5.Installing Vue, SASS and bootstrap 4 using WebPackEncore

--------------------------------------------------------------------------------------------

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 5.1.Installing Twig

--------------------------------------------------------------------------------------------

* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Twig Extension Component](https://symfony.com/doc/current/templating/twig_extension.html), `composer require twig/extensions`


```bash
composer require twig/extensions
```
(Source: [Twig Extension Component](https://symfony.com/doc/current/templating/twig_extension.html))

```bash
composer require symfony/asset
```
(Source: [Assets for Twig Component](https://symfony.com/doc/current/components/asset.html))

> We will add the line `<meta name="viewport" content="width=device-width, initial-scale=1.0">` for can use the responsive web in mobiles.

_[/templates/base.html.twig]()_
```diff
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
++    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{% block title %}Welcome!{% endblock %}</title>
      {% block stylesheets %}{% endblock %}
  </head>
  <body>
    {% block body %}{% endblock %}
    {% block javascripts %}{% endblock %}
  </body>
</html>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 5.2.Installing Vue using WebPackEncore

--------------------------------------------------------------------------------------------

(Source: [CloudWays - Getting Started With Vue.Js In Symfony](https://www.cloudways.com/blog/symfony-vuejs-app/))

First, make sure you [install Node.js](https://nodejs.org/en/download/) and also the [NPM package manager](https://www.npmjs.com).

We can use the commands `node -v` and `npm -v` to know the version installed in our computer.

Then, install Encore into your project with [NPM](https://www.npmjs.com):

```bash
npm install @symfony/webpack-encore --save-dev
```

If you are using Flex for your project, you can initialize your project for Encore via:

```bash
composer require encore
```
(Source: [Symfony Doc - Webpack Encore Component](https://symfony.com/doc/current/frontend/encore/installation.html))

This will create a webpack.config.js file, add the assets/ directory, and add node_modules/ to .gitignore.

This command creates (or modifies) a [package.json](./package.json) file and downloads dependencies into a [node_modules/](./node_modules/) directory. When using npm 5, a [package-lock.json](./package-lock.json) file is created/updated.

Next, create your [webpack.config.js](./webpack.config.js).

_[webpack.config.js](./webpack.config.js)_
```js
// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()

    // allow sass/scss files to be processed
    // .enableSassLoader()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();
```

_[/templates/base.html.twig]()_
```diff
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}Welcome!{% endblock %}</title>
    {% block stylesheets %}
++    <link rel="stylesheet" href="{{ asset('build/app.css') }}">
    {% endblock %}
  </head>
  <body>
    {% block body %}{% endblock %}
    {% block javascripts %}
++     <script src="{{ asset('build/app.js') }}"></script>  
    {% endblock %}
  </body>
</html>
```

Now, we install Vue and some dependencies:

```bash
npm i vue --save-dev
```
(Source: [https://www.npmjs.com/package/vue](https://www.npmjs.com/package/vue))

```bash
npm i vue-loader --save
```
(Source: [https://www.npmjs.com/package/vue-loader](https://www.npmjs.com/package/vue-loader))

```bash
npm i vue-template-compiler --save
```
(Source: [https://www.npmjs.com/package/vue-template-compiler](https://www.npmjs.com/package/vue-template-compiler))

Then, activate the **vue-loader** and its plugin in [webpack.config.js](./webpack.config.js):

_[webpack.config.js](./webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');
++ const { VueLoaderPlugin } = require('vue-loader');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
++  .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
++  // Enable Vue loader
++  .enableVueLoader()
++  .addPlugin(new VueLoaderPlugin())
++  ;
;

module.exports = Encore.getWebpackConfig();
```

> **Issue** [enableVueLoader does not include VueLoaderPlugin? #311](https://github.com/symfony/webpack-encore/issues/311) - [symfony - webpack-encore](https://github.com/symfony/webpack-encore)  

We can already create our first component of Vue:

_[/assets/js/app.js](/assets/js/app.js)_
```js
// assets/js/app.js
import Vue from 'vue';
 
import Example from './components/Example'
 
/**
* Create a fresh Vue Application instance
*/
new Vue({
  el: '#app',
  components: {Example}
});
```

And its component.

_[/assets/js/components/Example.vue]()_
```html
<template>
   <div>
       <p>This is an example of a new components in VueJs</p>
   </div>
</template>
 
<script>
   export default {
       name: "example"
   }
</script>
 
<style scoped>
 
</style>
```

_[/templates/base.html.twig]()_
```diff
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}Welcome!{% endblock %}</title>
    {% block stylesheets %}
      <link rel="stylesheet" href="{{ asset('build/app.css') }}">
    {% endblock %}
  </head>
  <body>
++  <div id="app">  
      {% block body %}{% endblock %}
++  </div>  
    {% block javascripts %}
      <script src="{{ asset('build/app.js') }}"></script>  
    {% endblock %}
  </body>
</html>
```

_[/templates/default/vue-example.html.twig]()_
```html
{% extends 'base.html.twig' %}
{% block body %}
 
   <div class="text-center">
       <h3>My Symfony 4 sample project</h3>
 
       <div class="jumbotron text-center">
           <example></example>
       </div>
   </div>
 
{% endblock %}
```

_[src/Resources/config/routing/default.yml](./src/Resources/config/routing/default.yml)_
```diff
# ...
test:
    path: /test
    controller: App\Controller\DefaultController::test
    #methods:   [POST]
++ test_vue_example:
++   path: /vue_example
++   controller: App\Controller\DefaultController::vueExample  
```

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Users;

class DefaultController extends Controller {
  // ...
++ public function vueExample (request $request) {
++   return $this->render('default/vue-example.html.twig');
++ }  
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 5.3.Installing SASS and bootstrap 4 

--------------------------------------------------------------------------------------------

First, we install Sass and Bootstrap dependencies:

```bash
npm i sass-loader --save-dev
```
(Source: [npm - sass-loader](https://www.npmjs.com/package/sass-loader))

```bash
npm i node-sass --save-dev
```
(Source: [npm - node-sass](https://www.npmjs.com/package/node-sass))

```bash
npm i bootstrap --save-dev
```
(Source: [npm - bootstrap](https://www.npmjs.com/package/bootstrap))

```bash
npm i jquery --save-dev
```
(Source: [npm - jquery](https://www.npmjs.com/package/jquery))

```bash
npm i popper.js --save
```
(Source: [npm - popper](https://www.npmjs.com/package/popper))

And we will have to modified the [webpack.config.js](./webpack.config.js) with the new configuration.

_[webpack.config.js](./webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');
const { VueLoaderPlugin } = require('vue-loader');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/scss/app.scss')

    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()
++  .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
    // Enable Vue loader
    .enableVueLoader()
    .addPlugin(new VueLoaderPlugin())
    ;
;

module.exports = Encore.getWebpackConfig();
```

Now modified the [/assets/js/app.js](./assets/js/app.js) for include the libraries **jquery** and **bootstrap** in our vue app.

_[/assets/js/app.js](./assets/js/app.js)_
```diff
// assets/js/app.js
++ import $ from 'jquery';
++ import 'bootstrap';

import Vue from 'vue';

import Example from './components/Example'
 
/**
* Create a fresh Vue Application instance
*/
new Vue({
  el: '#app',
  components: {Example}
});
```

And include the library **bootstrap** in our style file, 

_[/assets/scss/app.scss](./assets/scss/app.scss)_
```scss
@import '~bootstrap/scss/bootstrap';

$acceVerde: #84a640;
$acceAzul: #396696;

h1 {
    color: $acceVerde;

    s {
        color: $acceAzul;
    }
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 6.Creating a JSON Response

--------------------------------------------------------------------------------------------

> To convert data to Json using symfony it is necessary to have the `http-foundation` component ( Source: [The HttpFoundation Component](https://symfony.com/doc/current/components/http_foundation.html) ).

```bash
composer require symfony/http-foundation
```

1. First we will check the sending method jsonResponse, generating a test in the controller [/src/Controller/DefaultController.php](./src/Controller/DefaultController.php).

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

++ use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\User;

class DefaultController extends Controller {
  public function tests (Request $request){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(User::class);
    $userList = $user_repo->findAll();
++  /*
    return $this->render('base.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      'user'=>$user_repo
    ]);
++  */
++  return new JsonResponse(array(
++    'status' => 'succes',
++    'users' => $user_repo
++  ));
  }
}
```

> Although we use the `JsonResponse()` component, in symfony there is a default component which we access through `$this->json()`.

2. If we run `php bin/console server: run` and access [http://127.0.0.1:8000/](http://127.0.0.1:8000/) we will see that it does not convert correctly. Still we see that `JsonResponse()` does not perform the conversion correctly so we will have to generate a service that performs the conversion correctly.

> To create our encoder **Json** you must execute the command `composer require symfony/serializer` to download the **serializer component**.

```bash
composer require symfony/serializer
```

_[/src/Service/Helpers.php](./src/Service/Helpers.php)_
```php
<?php
// src/Service/Helpers.php
namespace App\Service;

class Helpers{
    public $manager;
	public function __construct($manager){
		$this->manager = $manager;
	}    
	public function json($data){
		$normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
		// 
		$encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());

		$serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
		$json = $serializer->serialize($data, 'json');

		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->setContent($json);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}
	public function decoding_json($json){
		$params = json_decode($json);
		return $params;
	}
}
```

* `GetSetMethodNormalizer`, This normalizer reads the content of the class by calling the "getters" (public methods starting with "get"). It will denormalize data by calling the constructor and the "setters" (public methods starting with "set").
Objects are normalized to a map of property names and values (names are generated removing the `get` prefix from the method name and lowercasing the first letter; e.g. `getFirstName() -> firstName`).

* **Encoders**, `JsonEncoder`, This class encodes and decodes data in JSON.

3. To use this new service it is necessary to declare it in [config/services.yaml](./config/services.yaml).

_[/config/services.yaml](./config/services.yaml)_
```diff
//...
    # controllers are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base controller class
    App\Controller\:
        resource: '../src/Controller'
        tags: ['controller.service_arguments']

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones
++  App\Service\Helpers:
++      public: true
++      arguments: 
++          $manager: '@doctrine.orm.entity_manager'
```

4. Inside the [src/Controller/DefaultController.php](./src/Controller/DefaultController.php) we will call it that.

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

++ use App\Service\Helpers;

use App\Entity\User;

class DefaultController extends Controller {
-- public function index (Request $request){
++ public function index (Request $request, Helpers $helpers){    
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(User::class);
    $userList = $user_repo->findAll();

++  return $helpers->json($userList);   
--  return new JsonResponse(array(
--      'status' => 'succes',
--      'users' => $userList
--  ));
  }
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.Login JWT

--------------------------------------------------------------------------------------------

1. Create the `function login` within [/src/Controller/AuthenticationController.php](./src/Controller/AuthenticationController.php).

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
++ use Symfony\Component\HttpFoundation\JsonResponse;

++ use Symfony\Component\Validator\Constraints as Assert;

++ use App\Service\Helpers;

//...
class AuthenticationController extends Controller {
  //..

++ public function login(Request $request, Helpers $helpers){
++  // Receive json by POST
++  $json = $request->get('json', null);
++  // Array to return by default
++  $data = array(
++      'status' => 'error',
++      'data' => 'Send json via post !!'
++    );
++  }
++  return $helpers->json($data);
++ }

//..
```

3. We add a new route in [src/Resources/config/routing/default.yml](./src/Resources/config/routing/default.yml).

_[/src/Resources/config/routing/authentication.yml](./src/Resources/config/routing/authentication.yml)_
```yml
authentication_login:
    path: /login
    controller: App\Controller\AuthenticationController::login
    methods:   [POST]
```
4. Access to [https://app.getpostman.com/](https://app.getpostman.com/) and send a petition to url [http://127.0.0.1:8000/api/v1/login](http://127.0.0.1:8000/api/v1/login)

> You must receive the following message: `{"status":"error","data":"Send json via post !!"}`.

5. We complete the **method login** so that it looks for the email match within the **User entity**.

_[/src/Controller/AuthenticationController.php](./src/Controller/AuthenticationController.php)_
```diff
//...
class AuthenticationController extends Controller {
  //..
  public function login(Request $request, Helpers $helpers){
    // Receive json by POST
    $json = $request->get('json', null);
    // Array to return by default
    $data = array( 'status' => 'error', 'data' => 'Send json via post !!' );
++  if($json != null){
++      // you make the login
++      // We convert a json to a php object
++      $params = json_decode($json);
++      $email = (isset($params->email)) ? $params->email : null;
++      $password = (isset($params->password)) ? $params->password : null;

++      $emailConstraint = new Assert\Email();
++      $emailConstraint->message = "This email is not valid !!";
++      $validate_email = $this->get("validator")->validate($email, $emailConstraint);

++      if($email != null && count($validate_email) == 0 && $password != null){
++          $data = array(
++              'status' => 'success',
++              'data' => 'Login success'
++          );
++      }else{
++          $data = array(
++              'status' => 'error',
++              'data' => 'Email or password incorrect'
++          );
++      }
++  }
    return $helpers->json($data);
  }
//..
```

6. Access to [https://app.getpostman.com/](https://app.getpostman.com/) and send a petition to url [http://127.0.0.1:8000/api/v1/login](http://127.0.0.1:8000/api/v1/login) using in the body `x-www-form-urlencoded` with **key** `json` and **value** `{"email":"admin@admin.com", "password":"1"}`.

> You must receive the following message: `{"status":"success","data":"Email or password success"}`.

7. we will need to create a new **service** that authenticates us and generates the token.

_[src/Service/JwtAuth.php](./src/Service/JwtAuth.php)_
```php
<?php
// src/Service/JwtAuth.php
namespace App\Service;

use App\Entity\User;
use Firebase\JWT\JWT;

class JwtAuth{
	public $manager;
	public $key;

	public function __construct($manager){
		$this->manager = $manager;
		$this->key = 'helloHowIAmTheSecretKey-98439284934829';
	}
	public function signup($email, $password, $getHash = null){
		$user = $this->manager->getRepository(User::class)->findOneBy(array(
			"email" => $email,
			"password" => $password
		));
		$signup = (is_object($user))? true : false;
		if($signup == true){
			// GENERATE TOKEN JWT
			$token = array(
				"sub"   => $user->getId(),
				"email" => $user->getEmail(),
				"name"	=> $user->getName(),
				"surname" => $user->getSurname(),
				"iat"	=> time(),
				"exp"	=> time() + (7 * 24 * 60 * 60)
			);
			$jwt = JWT::encode($token, $this->key, 'HS256');
			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
            $data = ($getHash == null)? $jwt : $decoded ;
		}else{
			$data = array( 'status' => 'error', 'data' => 'Login failed!!' );
		}
		return $data;
	}
}
```

> You need the library **Firebase\JWT**, to install execute the command `composer require firebase/php-jwt`.

8. To use this new service it is necessary to declare it in [config/services.yaml](./config/services.yaml).

_[config/services.yaml](./config/services.yaml)_
```diff
//...
    # controllers are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base controller class
    App\Controller\:
        resource: '../src/Controller'
        tags: ['controller.service_arguments']

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones
    App\Service\Helpers:
        public: true
        arguments: 
            $manager: '$manager: '@doctrine.orm.entity_manager'
++  App\Service\JwtAuth:
++      public: true
++      arguments: 
++          $manager: '@doctrine.orm.entity_manager'            
```

9. Now we will modify the **login method**, in [/src/Controller/AuthenticationController.php](./src/Controller/AuthenticationController.php), so that it consults in the database if the user exists and if it exists, it generates a **token**.

_[/src/Controller/AuthenticationController.php](./src/Controller/AuthenticationController.php)_
```diff
//...
use App\Service\Helpers;
++ use App\Service\JwtAuth;
//...
class AuthenticationController extends Controller {
  //..
-- public function login(Request $request, Helpers $helpers){
++ public function login(Request $request, Helpers $helpers, JwtAuth $jwt_auth ){    
    // Receive json by POST
    $json = $request->get('json', null);
    // Array to return by default
    $data = array( 'status' => 'error', 'data' => 'Send json via post !!' );
    if($json != null){
        // you make the login
        // We convert a json to a php object
        $params = json_decode($json);
        $email = (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;

        $emailConstraint = new Assert\Email();
        $emailConstraint->message = "This email is not valid !!";
        $validate_email = $this->get("validator")->validate($email, $emailConstraint);

        if($email != null && count($validate_email) == 0 && $password != null){
--          $data = array(
--              'status' => 'success',
--              'data' => 'Login success'
--          );
++          $jwt_auth = $this->get(JwtAuth::class);
++          if($getHash == null || $getHash == false){
++              $signup = $jwt_auth->signup($email, $pwd);
++          }else{
++              $signup = $jwt_auth->signup($email, $pwd, true);
++          }
++          return new JsonResponse($signup);
        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Email or password incorrect'
            );
        }
    }
    return $helpers->json($data);
  }
//..
```

> **IMPORTANT** We replace the return command `$this->json($signup);` by `return new JsonResponse($signup);` to avoid failures in the transformation to json.

10. we must generate a new method within the service that checks the token.

_[src/Service/JwtAuth.php](./src/Service/JwtAuth.php)_
```diff
//..
class JwtAuth{
    //..
++	public function checkToken($jwt, $getIdentity = false){
++      $auth = false;
++		try{
++			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
++      }catch(
++            \UnexpectedValueException $e){ $auth = false; 
++      }catch(
++            \DomainException $e){ $auth = false; 
++      }
++		if(isset($decoded) && is_object($decoded) && isset($decoded->sub)){ $auth = true; }else{ $auth = false; }
++		if($getIdentity == false){ 
++          return $auth; 
++      }else{
++          return $decoded; 
++      }
++  }
    //..
```

11. Now, I can post in [https://app.getpostman.com/](https://app.getpostman.com/) a new request to url [http://127.0.0.1:8000/api/v1/login](http://127.0.0.1:8000/api/v1/login) using in the body `x-www-form-urlencoded` with **key** `json` and **value** `{"email":"admin@admin.com", "password":"1"}` to collect the token. 

In our case we received:

```bash
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwibmFtZSI6ImFkbWluIiwic3VybmFtZSI6ImFkbWluIiwiaWF0IjoxNTI1MDk3NTEwLCJleHAiOjE1MjU3MDIzMTB9.UA3f6W2mqzrHCoJNvCqxHW4NmOFe-9sMVfNOXXPW_gY"
```

12. We modify the **test method** in [/src/Controller/DefaultController.php](./src/Controller/DefaultController.php).

_[/src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
//...
use App\Service\Helpers;
use App\Service\JwtAuth;
//...
class DefaultController extends Controller {
  public function test (Request $request, Helpers $helpers){
++  $token = $request->get("authorization", null);      
++  if ($token){  
        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository(User::class);
        $userList = $user_repo->findAll();

        return $helpers->json(array(
            'status' => 'success',
            'users' => $userList
        ));
++  } else {
--      return $helpers->json($userList);
++    return $helpers->json(array(
++      'status' => 'error',
++      'code' => 400,
++      'users' => 'Login failed!!!'
++    )); 
++  }
}
```

12. Again, I can post in [https://app.getpostman.com/](https://app.getpostman.com/) a new request to url [http://127.0.0.1:8000/api/v1/test](http://127.0.0.1:8000/api/v1/test) using in the body `x-www-form-urlencoded` with **key** `authorization` and **value** `"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwibmFtZSI6ImFkbWluIiwic3VybmFtZSI6ImFkbWluIiwiaWF0IjoxNTI1MDk3NTEwLCJleHAiOjE1MjU3MDIzMTB9.UA3f6W2mqzrHCoJNvCqxHW4NmOFe-9sMVfNOXXPW_gY"` to collect the token.

In our case we received:

```bash
{"status":"success","users":[{"id":1,"username":"","name":"admin","surname":"admin","email":"admin@admin.com","password":"1","createdAt":{"timezone":{"name":"UTC","transitions":[{"ts":-9223372036854775808,"time":"-292277022657-01-27T08:29:52+0000","offset":0,"isdst":false,"abbr":"UTC"}],"location":{"country_code":"??","latitude":0,"longitude":0,"comments":""}},"offset":0,"timestamp":1522540800},"salt":null,"role":"admin","roles":["ROLE_USER","ROLE ADMIN"]}]}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 8.Other Requests to the Api

--------------------------------------------------------------------------------------------

> To be able to access the rest of the requests, you must see the url of the request inside the routing files of the directory [/src/Resources/config/routing/](./src/Resources/config/routing/) and access the corresponding controller method [/src/Controller/](./src/Controller/).

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>
