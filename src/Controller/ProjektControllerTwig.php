<?php

namespace App\Controller;

use App\Entity\Milestones;
use App\Repository\MilestonesRepository;
use App\Entity\Statistics;
use App\Repository\StatisticsRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjektControllerTwig extends AbstractController
{
    #[Route("/proj", name: "projekt")]
    public function proj(
        MilestonesRepository $milestonesRepository
    ): Response {
        $milestones = $milestonesRepository
            ->findAll();

        $data = [
            'milestones' => $milestones,
        ];

        return $this->render('proj.html.twig', $data);
    }

    #[Route("/proj/about", name: "aboutprojekt")]
    public function aboutproj(): Response
    {
        return $this->render('proj/about.html.twig');
    }

    #[Route("/proj/ekonomi", name: "economic")]
    public function economic(
        StatisticsRepository $statisticsRepository
    ): Response {
        $lonutveckling = $statisticsRepository
            ->findBy(
                array('code'=> 'eco1')
            );

        $payedleave = $statisticsRepository
            ->findBy(
                array('code'=> 'eco2')
            );

        $childcare = $statisticsRepository
            ->findBy(
                array('code'=> 'eco3')
            );

        $data = [
            'lonutveckling' => $lonutveckling,
            'childcare' => $childcare,
            'payedleave' => $payedleave,
        ];

        return $this->render('proj/economic.html.twig', $data);
    }

    #[Route("/proj/utbildning", name: "education")]
    public function education(
        StatisticsRepository $statisticsRepository
    ): Response {
        $pisaL = $statisticsRepository
            ->findBy(
                array('category'=> 'Läsning')
            );

        $pisaM = $statisticsRepository
            ->findBy(
                array('category'=> 'Matematik')
            );

        $mscore = $statisticsRepository
            ->findBy(
                array('code'=> 'edu2')
            );

        $eduLevel = $statisticsRepository
            ->findBy(
                array('code'=> 'edu3'),
                array('year'=> 'ASC')
            );

        $data = [
            'pisaL' => $pisaL,
            'pisaM' => $pisaM,
            'mscore' => $mscore,
            'eduLevel' => $eduLevel,
        ];

        return $this->render('proj/education.html.twig', $data);
    }

    #[Route("/proj/hemarbete", name: "homelabor")]
    public function homelabor(
        StatisticsRepository $statisticsRepository
    ): Response {
        $weeklabor = $statisticsRepository
            ->findBy(
                array('code'=> 'hla1')
            );

        $weekendlabor = $statisticsRepository
            ->findBy(
                array('code'=> 'hla2')
            );

        $chores = $statisticsRepository
            ->findBy(
                array('code'=> 'hla3')
            );

        $data = [
            'week' => $weeklabor,
            'weekend' => $weekendlabor,
            'chores' => $chores,
        ];

        return $this->render('proj/homelabor.html.twig', $data);
    }

    #[Route("/proj/about/database", name: "aboutdatabase")]
    public function aboutdatabase(): Response
    {
        return $this->render('proj/about/database.html.twig');
    }
}
