<?php

namespace App\Controller;

use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(TestType::class);
        
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'form' => $form->createView()
        ]);
    }
}
