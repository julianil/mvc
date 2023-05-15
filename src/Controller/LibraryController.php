<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }
    #[Route('/library/create', name: 'library_create_get', methods: ['GET'])]
    public function newBook(
    ): Response {

        return $this->render('library/new_book.html.twig');
    }
    #[Route('/library/create', name: 'library_create_post', methods: ['POST'])]
    public function createBook(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $name = $request->request->get('name');
        $isbn = $request->request->get('isbn');
        $writer = $request->request->get('writer');
        $image = $request->request->get('image');
        $description = $request->request->get('description');

        $entityManager = $doctrine->getManager();

        $book = new library();
        $book->setName($name);
        $book->setIsbn($isbn);
        $book->setWriter($writer);
        $book->setImage($image);
        $book->setDescription($description);

        $entityManager->persist($book);

        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }
    #[Route('/library/show', name: 'library_show_all')]
    public function showAllBooks(
        LibraryRepository $libraryRepository
    ): Response {
        $books = $libraryRepository
            ->findAll();

        $data = [
            'books' => $books,
        ];

        return $this->render('library/books.html.twig', $data);
    }
    #[Route('/library/show/{id}', name: 'library_by_id')]
    public function showBookById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        $data = [
            'book' => $book,
        ];

        return $this->render('library/book.html.twig', $data);
    }
    #[Route('/library/delete/{id}', name: 'library_delete_by_id')]
    public function deleteBookById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $libraryRepository->remove($book, true);

        return $this->redirectToRoute('library_show_all');
    }
    #[Route('/library/update/{id}', name: 'library_update_get', methods: ['GET'])]
    public function updateBookForm(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        $data = [
            'book' => $book,
        ];

        return $this->render('library/update_book.html.twig', $data);
    }
    #[Route('/library/update/{id}', name: 'library_update_post', methods: ['POST'])]
    public function updateBook(
        LibraryRepository $libraryRepository,
        int $id,
        Request $request,
    ): Response {
        $name = $request->request->get('name');
        $isbn = $request->request->get('isbn');
        $writer = $request->request->get('writer');
        $image = $request->request->get('image');

        $book = $libraryRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $book->setName($name);
        $book->setIsbn($isbn);
        $book->setWriter($writer);
        $book->setImage($image);
        $libraryRepository->save($book, true);

        return $this->redirectToRoute('library_show_all');
    }
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
    #[Route("/api", name: "api_book_post", methods: ['POST'])]
    public function initCallback(
        LibraryRepository $libraryRepository,
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
        int $isbn
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
