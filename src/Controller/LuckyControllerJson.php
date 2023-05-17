<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\Card;
use App\Card\CardHand;
use App\Repository\LibraryRepository;

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
        SessionInterface $session,
        LibraryRepository $libraryRepository
    ): Response {
        $fullDeck = new DeckOfCards();
        $fullDeck->addCards();
        $session->set("deck", $fullDeck);

        $books = $libraryRepository
            ->findAll();

        $data = [
            'books' => $books,
        ];

        return $this->render('api.html.twig', $data);
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
}
