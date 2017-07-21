<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HeroController extends HeroSearchController
{
  /**
   * @Route("/hero/{slug}", name="hero")
   */
  public function showAction($slug) {
    $query = $this->connectToApi();
    $hero = $this->getHeroById($query, $slug);

    return $this->render('node/node-hero.html.twig', array(
      'hero' => $hero,
    ));
  }

  public function getHeroById($query, $id)
  {
    $response = file_get_contents('http://gateway.marvel.com/v1/public/characters/' . $id .'?' . $query);
    $response_data = json_decode($response, true);

    $results = $response_data['data']['results'];

    $hero = new Hero();
    $hero->setHeroId($results[0]['id']);
    $hero->setName($results[0]['name']);
    $hero->setDescription($results[0]['description']);
    $hero->setImageUrl($results[0]['thumbnail']['path']);
    $hero->setImageExtension($results[0]['thumbnail']['extension']);

    if(empty($hero->getDescription())) {
      $hero->setDescription('Oops this seems to appear empty:(');
    }
    return $hero;
  }
}