<?php
// src/Controller/AuthenticationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Utils\DateTimeUtils;

use App\Service\Helpers;
use App\Service\JwtAuth;

abstract class AppCinemaAbstractController extends Controller
{
    private $dateTimeUtils;
    public $jwt_auth;
    public $helpers;
  
    public function __construct( JwtAuth $jwt_auth, Helpers $helpers, DateTimeUtils $dateTimeUtils){
      $this->dateTimeUtils = $dateTimeUtils;
      $this->jwt_auth = $jwt_auth;
      $this->helpers = $helpers;
    }
}