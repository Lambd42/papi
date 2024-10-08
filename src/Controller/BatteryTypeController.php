<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BatteryTypeRepository;
use App\Entity\BatteryType;
use App\Form\UpdateBatteryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BatteryTypeController extends AbstractController
{

    #[Route('/admin-liste-typebatterie', name: 'app_batteryTypesList')]
    public function batteryTypesList(BatteryTypeRepository $batteryTypeRepository): Response
    {
        $batteryTypes = $batteryTypeRepository->findAll();
        return $this->render('battery_type/batteryTypesList.html.twig', [
            'batteryTypes' => $batteryTypes
        ]);
    }

    #[Route('/batteryType/update/{id}', name: 'app_updateBatteryType')]
    public function updateBatteryType(Request $request, BatteryType $batteryType, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UpdateBatteryType::class, $batteryType);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($batteryType);
                $em->flush();
                $this->addFlash('notice','Type modifié');
                return $this->redirectToRoute('app_batteryTypesList');
            }
        }

        return $this->render('battery_type/updateBatteryType.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/batteryType/delete/{id}', name: 'app_deleteBatteryType')]
    public function deleteBatteryType(Request $request, BatteryType $batteryType, EntityManagerInterface $em): Response
    {
        if($batteryType!=null){
            $em->remove($batteryType);
            $em->flush();
            $this->addFlash('notice','Type de batterie supprimé');
        }

        return $this->redirectToRoute('app_batteryTypesList');
    }
}
