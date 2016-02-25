<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class WelcomeController extends Controller
{
	public function indexAction(){
		$data = ['lucky_number' => rand(0, 100)];

        return new JsonResponse($data);
	}
}
