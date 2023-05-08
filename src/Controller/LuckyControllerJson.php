<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\Card;
use App\Card\CardHand;
use App\Card\CardGraphic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LuckyControllerJson extends AbstractController
{
    #[Route("/api", name: "api_get", methods: ['GET'])]
    public function jsonStart(
        SessionInterface $session
    ): Response {
        $fullDeck = new DeckOfCards();
        $fullDeck->addCards();
        $session->set("deck", $fullDeck);
        return $this->render('api.html.twig');
    }

    #[Route("/api/deck/draw", name: "api_draw_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response {

        $numCards = $request->request->get('num_cards');
        $session->set("drawn_cards", $numCards);

        $data = [
            "num" => $numCards,
        ];

        if ($numCards == 1) {
            return $this->redirectToRoute('api_draw_get', $data);
        }
        return $this->redirectToRoute('api_draw_many_get', $data);
    }

    #[Route("/api/quote", name: "api_quote")]
    public function jsonNumber(): Response
    {
        $quotesArray = array("You have to somehow convince yourself of the magic of life. Around every corner, a new adventure... - Marianne Zetterström",
        "To cover a fault with a lie is to replace a stain with a hole. - Ferdinand Von Schirr",
        "Nothing is impossible. The impossible just takes a little longer. - Winston Churchill",
        "Tis better to have loved and lost than never to have loved at all. - Alfred Lord Tennyson");

        $quote = $quotesArray[array_rand($quotesArray)];

        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d');
        $timestamp = date('Y-m-d H:i:s');

        $data = [
            'todays-date' => $date,
            'todays-quote' => $quote,
            'timestamp' => $timestamp,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() |  JSON_PRETTY_PRINT
        );
        return $response;
    }

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

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_draw_many_get")]
    public function drawMany(
        int $num,
        SessionInterface $session
    ): Response {
        $fullDeck = $session->get("deck");

        if ($num > 52) {
            var_dump("No more cards in the pile");
        }

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
