<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->connectToApi();
        $this->retrieveByName('spider', $this->connectToApi());
    }

    public function connectToApi() {
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

    public function retrieveByName($name, $query) {
      //make the request
      $response = file_get_contents('http://gateway.marvel.com/v1/public/characters?nameStartsWith=' . $name . '&' . $query);

      //convert the json string to an array
      $response_data = json_decode($response, true);

      $hero_name = $response_data['data']['results'][4]['name'];
      $hero_description = $response_data['data']['results'][4]['description'];

      var_dump($hero_name, $hero_description);die;

    }
}
