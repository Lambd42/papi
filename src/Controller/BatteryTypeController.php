<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BatteryTypeController extends AbstractController
{

    #[Route('/liste-typebatterie', name: 'app_batteryTypesList')]
    public function batteryTypesList(): Response
    {
        return $this->render('base/batteryTypesList.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
