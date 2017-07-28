<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 17.7.24
 * Time: 13.18
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends HeroSearchController {

  /**
   * @Route("/", name="home")
   */
  public function showAction() {
    return $this->render('home/home.html.twig');
  }
}