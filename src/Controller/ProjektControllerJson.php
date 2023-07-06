<?php

namespace App\Controller;

use App\Entity\Milestones;
use App\Repository\MilestonesRepository;
use App\Entity\Statistics;
use App\Repository\StatisticsRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjektControllerJson extends AbstractController
{
    #[Route("/proj/api", name: "projekt_api")]
    public function proj_api(
        MilestonesRepository $milestonesRepository
    ): Response {
        $milestones = $milestonesRepository
            ->findAll();

        $data = [
            'milestones' => $milestones
        ];

        return $this->render('proj/api.html.twig', $data);
    }

    #[Route("/proj/api/milestones", name: "api_milestones")]
    public function api_milestones(
        MilestonesRepository $milestonesRepository
    ): Response {
        $milestones = $milestonesRepository
            ->findAll();

        $response = $this->json($milestones);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/proj/api/ekonomi", name: "api_economy")]
    public function api_economy(
        StatisticsRepository $statisticsRepository
    ): Response {
        $economy = $statisticsRepository
            ->findBy(
                array('code'=> array('eco1', 'eco2', 'eco3'))
            );

        $response = $this->json($economy);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/proj/api/utbildning", name: "api_education")]
    public function api_education(
        StatisticsRepository $statisticsRepository
    ): Response {
        $education = $statisticsRepository
            ->findBy(
                array('code'=> array('edu1', 'edu2', 'edu3'))
            );

        $response = $this->json($education);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/proj/api/hemarbete", name: "api_homelabor")]
    public function api_homelabor(
        StatisticsRepository $statisticsRepository
    ): Response {
        $home = $statisticsRepository
            ->findBy(
                array('code'=> array('hla1', 'hla2', 'hla3'))
            );

        $response = $this->json($home);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("proj/api/indicator", name: "api_indicator_post", methods: ['POST'])]
    public function post_table(
        Request $request
    ): Response {

        $table= $request->request->get('table');

        $data = [
            "table" => $table,
        ];

        return $this->redirectToRoute('api_choosen_table', $data);
    }
    #[Route('proj/api/{table}', name: 'api_choosen_table')]
    public function apiShowTable(
        StatisticsRepository $statisticsRepository,
        $table
    ): Response {
        $table = $statisticsRepository
            ->findBy(
                array('code' => $table)
            );

        $response = $this->json($table);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
