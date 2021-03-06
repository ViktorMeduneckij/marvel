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


class HeroSearchController extends Controller
{
    /**
     * @Route("/heroes", name="hero_search")
     */
    public function indexAction(Request $request)
    {
      $heroName = $request->request->get('search');


      $query = $this->connectToApi();

      $all_heroes = $this->retrieveAll($query);
      $filteredHeroes = $this->letterFiltering($_COOKIE["letterOption"], $query);

      if($filteredHeroes) {
        $all_heroes = $filteredHeroes;
      }

      if(!empty($heroName)) {
        $heroes = $this->retrieveByName($heroName, $query);
        return $this->render('hero_search/hero_search.html.twig', array(
          'heroes' => $heroes,
        ));
      }
      return $this->render('hero_search/hero_search.html.twig', array(
        'heroes' => null,
        'allheroes' => $all_heroes,
      ));
    }

    public function connectToApi()
    {
      //Create a TimeStamp
      $ts = time();
      $public_key = '4a23db65667e6501465d203a11696099';
      $private_key = '8cd5f6fa634d1764610398f1583ef885f1cfef01';
      $hash = md5($ts . $private_key . $public_key);

      $query_params = [
        'apikey' => $public_key,
        'ts' => $ts,
        'hash' => $hash
      ];

      //convert array into query parameters
      $query = http_build_query($query_params);

      return $query;
    }

    public function retrieveByName($name, $query)
    {
      //make the request
      $response = file_get_contents('http://gateway.marvel.com/v1/public/characters?nameStartsWith=' . $name . '&' . $query);

      //convert the json string to an array
      $response_data = json_decode($response, true);

      $results = $response_data['data']['results'];

      //Define a new array in which I will store all of the heroes and their info returned by API
      $all_heroes = array();
      for($i = 0; $i < count($results); $i++) {
          $hero[$i] = new Hero();

          $hero[$i]->setHeroId($results[$i]['id']);
          $hero[$i]->setName($results[$i]['name']);
          $hero[$i]->setImageUrl($results[$i]['thumbnail']['path']);
          $hero[$i]->setImageExtension($results[$i]['thumbnail']['extension']);
          array_push($all_heroes, $hero[$i]);
      }
      return $all_heroes;
    }

  public function retrieveAll($query)
  {
    //make the request
    $response = file_get_contents('http://gateway.marvel.com/v1/public/characters?limit=100&' . $query);

    //convert the json string to an array
    $response_data = json_decode($response, true);

    $results = $response_data['data']['results'];


    //Define a new array in which I will store all of the heroes and their info returned by API
    $all_heroes = array();
    for($i = 0; $i < count($results); $i++) {
      $hero[$i] = new Hero();

      $hero[$i]->setHeroId($results[$i]['id']);
      $hero[$i]->setName($results[$i]['name']);
      $hero[$i]->setImageUrl($results[$i]['thumbnail']['path']);
      $hero[$i]->setImageExtension($results[$i]['thumbnail']['extension']);
      array_push($all_heroes, $hero[$i]);
    }
    return $all_heroes;
  }

  function letterFiltering($cookie, $query) {
    if(isset($cookie)) {
      $letterOption = $cookie;
      if($letterOption == 'None') {
        $this->retrieveAll($query);
      }

      $response = file_get_contents('http://gateway.marvel.com/v1/public/characters?nameStartsWith=' . $letterOption . '&limit=100&' . $query);

      //convert the json string to an array
      $response_data = json_decode($response, true);

      $results = $response_data['data']['results'];

      $all_heroes = array();
      for($i = 0; $i < count($results); $i++) {
        $hero[$i] = new Hero();

        $hero[$i]->setHeroId($results[$i]['id']);
        $hero[$i]->setName($results[$i]['name']);
        $hero[$i]->setImageUrl($results[$i]['thumbnail']['path']);
        $hero[$i]->setImageExtension($results[$i]['thumbnail']['extension']);
        array_push($all_heroes, $hero[$i]);
      }
      return $all_heroes;
    }
  }
}
