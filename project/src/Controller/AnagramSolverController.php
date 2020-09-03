<?php

namespace App\Controller;

use App\Form\AnagramSolverType;
use App\Service\AnagramSolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnagramSolverController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request, AnagramSolverService $anagramSolverService)
    {
        $form = $this->createForm(AnagramSolverType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();
            $initalString = $data['initialString'];
            $stringToCompare =  $data['stringToCompare'];
            $p = $anagramSolverService->run($initalString, $stringToCompare);
        }else{
            $p = null;
            $initalString = null;
            $stringToCompare = null;
        }



        return $this->render('anagram_solver/index.html.twig', [
            'initialString' => $initalString,
            'stringToCompare' => $stringToCompare,
            'p' => $p,
            'form' => $form->createView()
        ]);
    }
}
