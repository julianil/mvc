<?php

namespace App\Controller;

use Exception;
use App\Card\DeckOfCards;
use App\Card\Card;
use App\Card\CardHand;
use App\Card\CardGraphic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LuckyControllerGame extends AbstractController
{
    #[Route("/game", name: "game_init_get", methods: ['GET'])]
    public function game(
        SessionInterface $session
    ): Response {
        $hand = new CardHand();
        $hand->add(new Card());
        $hand->drawOneCard();
        $session->set("hand", $hand);
        $deck = new DeckOfCards();
        $deck->addCards();
        $session->set("deck", $deck);
        $session->set("points", 0);

        return $this->render('game.html.twig');
    }

    #[Route("/cardgame", name: "card_game", methods: ['GET'])]
    public function cardGame(
        SessionInterface $session
    ): Response {

        $hand = $session->get("hand");
        $session->set("points", $hand->getScoreHand());
        $score = $session->get("points");
        $currentDeck = $session->get("deck");
        $currentDeck->updateDeck($hand);
        $session->set("deck", $currentDeck);

        $data = [
            "hand_of_cards" => $hand->getString(),
            "total_score" => $score,
            "num_cards" => $hand->getNumberCards(),
        ];

        return $this->render('/cardgame.html.twig', $data);
    }

    #[Route("/cardgame", name: "card_game_post", methods: ['POST'])]
    public function gameDraw(
        SessionInterface $session
    ): Response {

        $hand = $session->get("hand");

        $hand->add(new Card());
        $hand->drawOneCard();

        $session->set("hand", $hand);

        return $this->redirectToRoute('card_game');
    }

    #[Route("/cardgame_result", name: "game_result", methods: ['GET'])]
    public function gameResult(
        SessionInterface $session
    ): Response {

        $deck = $session->get("deck");
        $player = $session->get("hand");
        $playerScore = $session->get("points");

        $hand = new CardHand();

        $hand->bankHand($hand);
        $score = $hand->getScoreHand();

        $winner = $hand->getWinner($player, $hand);

        $data = [
            "computer_hand" => $hand->getString(),
            "player_hand" => $player->getString(),
            "total_score" => $playerScore,
            "total_score_computer" => $score,
            "winner" => $winner,
            "deck" => $deck->getString(),
        ];

        return $this->render('/cardgame_result.html.twig', $data);
    }

    #[Route("/game/doc", name: "game_doc")]
    public function gameDoc(): Response
    {

        return $this->render('/gamedoc.html.twig');
    }
}
