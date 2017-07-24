<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 17.7.24
 * Time: 11.33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Comic;
use AppBundle\Entity\Creator;
use AppBundle\Entity\Hero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ComicController extends HeroSearchController {

  /**
   * @Route("/comic/{slug}", name="comic")
   */
  public function showAction(Request $request, $slug) {

    $query = $this->connectToApi();
    $comic = $this->getComicById($query, $slug);
    $creators = $this->getCreatorsByComicId($query, $slug);
    $heroes = $this->getComicCharacters($query, $slug);

    return $this->render('node/node-comic.html.twig', array(
      'comic' => $comic,
      'creators' => $creators,
      'heroes' => $heroes,
    ));
  }

  public function getComicById($query, $id) {

    $response = file_get_contents('http://gateway.marvel.com/v1/public/comics/' . $id .'?' . $query);
    $response_data = json_decode($response, true);

    $results = $response_data['data']['results'];

    $comic = new Comic();
    $comic->setTitle($results[0]['title']);
    $comic->setDescription($results[0]['description']);
    $comic->setPageCount($results[0]['pageCount']);
    $comic->setCreators($results[0]['creators']['collectionURI']);
    $comic->setCharacters($results[0]['characters']['collectionURI']);
    $comic->setCoverPath($results[0]['thumbnail']['path']);
    $comic->setCoverExtension($results[0]['thumbnail']['extension']);

    return $comic;
  }

  public function getCreatorsByComicId($query, $id) {
    $response = file_get_contents('http://gateway.marvel.com/v1/public/comics/' . $id .'/creators?' . $query);
    $response_data = json_decode($response, true);

    $results = $response_data['data']['results'];

    $all_creators = array();

    for($i = 0; $i < count($results); $i++) {
      $creator[$i] = new Creator();

      $creator[$i]->setFirstName($results[$i]['firstName']);
      $creator[$i]->setLastName($results[$i]['lastName']);

      array_push($all_creators, $creator[$i]);
    }

    return $all_creators;
  }

  public function getComicCharacters($query, $id) {
    $response = file_get_contents('http://gateway.marvel.com/v1/public/comics/' . $id .'/characters?' . $query);
    $response_data = json_decode($response, true);

    $results = $response_data['data']['results'];

    $all_heroes = array();

    for($i = 0; $i < count($results); $i++) {
      $hero[$i] = new Hero();
      $hero[$i]->setName($results[$i]['name']);
      $hero[$i]->setImageUrl($results[$i]['thumbnail']['path']);
      $hero[$i]->setImageExtension($results[$i]['thumbnail']['extension']);

      array_push($all_heroes, $hero[$i]);
    }

    return $all_heroes;
  }
}