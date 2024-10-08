<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BatteryTypeRepository;

class BatteryTypeController extends AbstractController
{

    #[Route('/liste-typebatterie', name: 'app_batteryTypesList')]
    public function batteryTypesList(BatteryTypeRepository $batteryTypeRepository): Response
    {
        $batteryTypes = $batteryTypeRepository->findAll();
        return $this->render('battery_type/batteryTypesList.html.twig', [
            'batteryTypes' => $batteryTypes
        ]);
    }
}
