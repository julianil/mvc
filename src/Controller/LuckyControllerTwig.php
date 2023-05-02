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

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $dice = random_int(1, 6);

        $data = [
            'number' => $dice
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/card", name: "card_init_get", methods: ['GET'])]
    public function card(
        SessionInterface $session
    ): Response
    {
        $fullDeck = new DeckOfCards();

        $fullDeck->addCards();

        $session->set("current_deck", $fullDeck);
        return $this->render('card.html.twig');
    }

    #[Route("/card", name: "card_init_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response {
        $numCards = $request->request->get('num_cards');
        $session->set("drawn_cards", $numCards);
        $session->set("total_cards", 52);

        $data = [
            "num" => $numCards,
        ];

        return $this->redirectToRoute('draw_num_cards', $data);
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(
        SessionInterface $session
    ): Response
    {
        $fullDeck = $session->get("current_deck");

        $data = [
            "get_cards" => $fullDeck->getString(),
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffel", name: "shuffel")]
    public function shuffel(
        SessionInterface $session
    ): Response
    {
        $fullDeck = $session->get("current_deck");

        $fullDeck->shuffleDeck();

        $data = [
            'cards' => $fullDeck->getString(),
        ];

        return $this->render('card/deck/shuffel.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "draw", methods: ['GET'])]
    public function draw(
        SessionInterface $session
    ): Response {
        $card = new Card();
        //$card = new CardGraphic();

        $num = 1;
        $amountOfCards = $session->get("total_cards");
        $session->set("total_cards", ($amountOfCards - $num));

        $data = [
            'num_cards' => $num,
            'num_cards_left' => $session->get("total_cards"),
            'card_array' => $card->drawCard(),
            'drawn_card' => $card->getAsString(),
        ];

        return $this->render('card/deck/draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_num_cards")]
    public function drawCards(
        int $num,
        SessionInterface $session
    ): Response {
        if ($num > 52) {
            throw new \Exception("No more cards in the pile");
        }

        $deck = $session->get("current_deck");
        $hand = new CardHand();
        for ($i = 1; $i <= $num; $i++) {
            $hand->add(new Card());
        }

        $hand->drawCard($deck);

        $amountOfCards = $session->get("total_cards");
        $session->set("total_cards", ($amountOfCards - $num));

        $data = [
            "num_cards" => $hand->getNumberCards(),
            'num_cards_left' => $session->get("total_cards"),
            "drawn_cards" => $hand->getString(),
        ];

        return $this->render('card/deck/draw_many.html.twig', $data);
    }

    #[Route("/game", name: "game_init_get", methods: ['GET'])]
    public function game(
        SessionInterface $session
    ): Response
    {
        $hand = new CardHand();
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
        var_dump($score);

        $data = [
            "hand_of_cards" => $hand->getString(),
            "total_score" => $score,
        ];

        return $this->render('/cardgame.html.twig', $data);
    }

    #[Route("/cardgame", name: "card_game_post", methods: ['POST'])]
    public function gameDraw(
        SessionInterface $session
    ): Response {

        $deck = $session->get("deck");
        $hand = $session->get("hand");

        $hand->add(new Card());
        $hand->drawCard($deck);

        $session->set("hand", $hand);

        return $this->redirectToRoute('card_game');
    }

    #[Route("/game/doc", name: "game_doc")]
    public function gameDoc(): Response {

        return $this->render('/gamedoc.html.twig');
    }
}
