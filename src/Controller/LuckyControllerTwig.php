<?php

namespace App\Controller;

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
    public function card(): Response
    {
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
    public function deck(): Response
    {
        $full_deck = new DeckOfCards();

        $full_deck->add_cards();

        $data = [
            "get_cards" => $full_deck->getString(),
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffel", name: "shuffel")]
    public function shuffel(): Response
    {
        $full_deck = new DeckOfCards();

        $full_deck->add_cards();

        $full_deck->shuffleDeck();

        $data = [
            'cards' => $full_deck->getString(),
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
        $amount_of_cards = $session->get("total_cards");
        $session->set("total_cards", ($amount_of_cards - $num));

        $data = [
            'num_cards' => $num,
            'num_cards_left' => $session->get("total_cards"),
            'card_array' => $card->draw_card(),
            'drawn_card' => $card->getAsString(),
        ];

        return $this->render('card/deck/draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_num_cards")]
    public function draw_cards(
        int $num,
        SessionInterface $session
    ): Response {
        if ($num > 52) {
            throw new \Exception("No more cards in the pile");
        }

        $hand = new CardHand();
        for ($i = 1; $i <= $num; $i++) {
            $hand->add(new Card());
        }

        $hand->draw_card();

        $amount_of_cards = $session->get("total_cards");
        $session->set("total_cards", ($amount_of_cards - $num));

        $data = [
            "num_cards" => $hand->getNumberCards(),
            'num_cards_left' => $session->get("total_cards"),
            "drawn_cards" => $hand->getString(),
        ];

        return $this->render('card/deck/draw_many.html.twig', $data);
    }
}
