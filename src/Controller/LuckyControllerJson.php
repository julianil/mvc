<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    #[Route("/api/quote")]
    public function jsonNumber(): Response
    {
        $quotes_array = array("You have to somehow convince yourself of the magic of life. Around every corner, a new adventure... - Marianne Zetterström", 
        "To cover a fault with a lie is to replace a stain with a hole. - Ferdinand Von Schirr",
        "Nothing is impossible. The impossible just takes a little longer. - Winston Churchill", 
        "Tis better to have loved and lost than never to have loved at all. - Alfred Lord Tennyson");

        $quote = $quotes_array[array_rand($quotes_array)];

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