<?php

namespace App\Controller;

use App\Form\AnagramSolverType;
use App\Service\AnagramSolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $initalString = $data['initialString'];
            $stringToCompare = $data['stringToCompare'];
            $p = $anagramSolverService->run($initalString, $stringToCompare);
        } else {
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

    /**
     * @Route("/api/anagram-solver/run")
     */
    public function api(Request $request, AnagramSolverService $anagramSolverService)
    {
        $initialString = $request->get('initialString', null);
        $stringToCompare = $request->get('stringToCompare', null);

        if($initialString === null || $stringToCompare === null){
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }

        $p = $anagramSolverService->run($initialString, $stringToCompare);

        return $this->json(['data' =>
            [
                'initialString' => $initialString,
                'stringToCompare' => $stringToCompare,
                'p' => $p,
            ]
        ]);
    }
}
