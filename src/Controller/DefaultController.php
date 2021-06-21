<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                [],
            [
                'id' => 'DESC'
            ],
                3
            ); 

        return $this->render('index.html.twig', ['programs' => $programs,]);
    }

    /**
     * @Route("/my-profile", name="my_account")
     */
    public function myAccount()
    {
        $info = $this->getUser()->getEmail();
        return $this->render('my_account.html.twig', ['info' => $info]);
    }
}