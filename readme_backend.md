# Symfony 4 - Task Manager (Backend)

We will make the backend of the application with the framework Symfony. We will have two entities, **User** and **Task**. Access to the login will be via `Jwt`

### Phases of the Demo
1. []()


---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton symfony`

---------------------------------------------------------------------------------------

### Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Apache-Pack Component](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules), `composer require symfony/apache-pack`
* [Var-dumper Component](https://symfony.com/doc/current/components/var_dumper.html), `composer require symfony/var-dumper`. **Note** If using it inside a Symfony application, make sure that the DebugBundle has been installed (or run `composer require symfony/debug-bundle` to install it).
* [Debug-Bundle Component](https://symfony.com/doc/current/components/debug.html), `composer require debug --dev`
* [The Config Component](https://symfony.com/doc/current/components/config.html), `composer require symfony/config`.

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

# Symfony 4 - Task Manager (Backend)

--------------------------------------------------------------------------------------------

### 1.Project Creation

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

--------------------------------------------------------------------------------------------

### 2.Database Configuration

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

--------------------------------------------------------------------------------------------

### 3.Entities

--------------------------------------------------------------------------------------------

1. Now, We can generate our user and task entities.

#### User Entity

_[config/doctrine/User.orm.yml](./symfony/config/doctrine/User.orm.yml)_
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

_[src/Entity/User.php](./symfony/src/Entity/User.php)_
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

> We can load the database ([/symfony/bbdd/bbdd.sql](./symfony/bbdd/bbdd.sql)) using phmyadmin and enter a first example user.

--------------------------------------------------------------------------------------------

### 4.Routing

--------------------------------------------------------------------------------------------

1. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](./symfony/config/routes.yaml)_
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

2. Next step is defined our folder with routing files of our app in [src/Resources/config/routing.yml](./symfony/src/Resources/config/routing.yml)

_[src/Resources/config/routing.yml](./symfony/src/Resources/config/routing.yml)_
```yml
app_routing_folder:
    # loads routes from the given routing file stored in some bundle
    resource: 'routing\' 
    type: directory
```

_[src/Resources/config/routing/default.yml](./symfony/src/Resources/config/routing/default.yml)_
```yml
default_pruebas:
    path: /test
    controller: App\DefaultController::test
    #methods:   [POST] 
```

3. Now we can test the generated entities and the router. For this we generate a first controller [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/AuthenticationController.php) with a method `tests()`.

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```php
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\Users;

class DefaultController extends Controller {
  public function index (request $request) {
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
    return $this->render('base.html.twig', [
      'base_dir' =>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      'user'=>$user_repo
    ]);
  }
}
```

4. If we run `php bin/console server:run` and access [http://127.0.0.1:8000/test](http://127.0.0.1:8000/test) we can see the existing entity.
