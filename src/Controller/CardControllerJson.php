<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\Card;
use App\Card\CardHand;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardControllerJson extends AbstractController
{
    #[Route("/api/deck", name: "api_deck")]
    public function jsonSortedDeck(
        SessionInterface $session
    ): Response {
        $fullDeck = $session->get("deck");

        $data = [
            "deck_of_cards" => $fullDeck->getString(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() |  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle")]
    public function jsonShuffelDeck(
        SessionInterface $session
    ): Response {
        $fullDeck = new DeckOfCards();

        $fullDeck->addCards();

        $fullDeck->shuffleDeck();

        $session->set("deck", $fullDeck);

        $data = [
            'shuffled_deck' => $fullDeck->getString(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() |  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_draw_get", methods: ['GET'])]
    public function drawACard(
        SessionInterface $session
    ): Response {
        $fullDeck = $session->get("deck");

        $hand = new CardHand();
        for ($i = 1; $i <= 1; $i++) {
            $hand->add(new Card());
        }

        $hand->drawCard($fullDeck->getString());

        $fullDeck->updateDeck($fullDeck->getString(), $hand->getString());
        $session->set("deck", ($fullDeck));

        $data = [
            'num_cards' => $hand->getNumberCards(),
            'amount_cards_left' => $fullDeck->getNumberCards(),
            'drawn_card' => $hand->getString(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_draw_many_post", methods: ['POST'])]
    public function initCallback(
        Request $request
    ): Response {

        $num = $request->request->get('num');

        $data = [
            "num" => $num,
        ];

        return $this->redirectToRoute('api_draw_many', $data);
    }

    #[Route("/api/deck/draw/{num}", name: "api_draw_many")]
    public function drawMany(
        int $num,
        SessionInterface $session
    ): Response {
        $fullDeck = $session->get("deck");

        $hand = new CardHand();
        for ($i = 1; $i <= $num; $i++) {
            $hand->add(new Card());
        }

        $hand->drawCard($fullDeck->getString());

        $fullDeck->updateDeck($fullDeck->getString(), $hand->getString());
        $session->set("deck", ($fullDeck));

        $data = [
            "num_cards" => $hand->getNumberCards(),
            'num_cards_left' => $fullDeck->getNumberCards(),
            "drawn_cards" => $hand->getString(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() |  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/game", name: "api_game")]
    public function jsonGame(
        SessionInterface $session
    ): Response {
        $player = $session->get("hand");
        $playerScore = $session->get("points");

        $data = [
            "player_score" => $playerScore,
            "player_hand" => $player->getString(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() |  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
