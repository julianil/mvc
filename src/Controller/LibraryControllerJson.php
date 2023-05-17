<?php

namespace App\Controller;

use App\Repository\LibraryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LibraryControllerJson extends AbstractController
{
    #[Route('/api/library/books', name: 'api_library_show_all')]
    public function apiShowAllBooks(
        LibraryRepository $libraryRepository
    ): Response {
        $books = $libraryRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
    #[Route("/api/library/book", name: "api_book_post", methods: ['POST'])]
    public function initCallback(
        Request $request
    ): Response {

        $isbn = $request->request->get('isbn');

        $data = [
            "isbn" => $isbn,
        ];

        return $this->redirectToRoute('api_library_by_isbn', $data);
    }
    #[Route('/api/library/book/{isbn}', name: 'api_library_by_isbn')]
    public function apiShowBookByIsbn(
        LibraryRepository $libraryRepository,
        string $isbn
    ): Response {
        $book = $libraryRepository
            ->findOneBy(array('isbn' => $isbn));

        $response = $this->json($book);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
