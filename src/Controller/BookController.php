<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use App\Form\EntryFormType;
use App\Entity\Books;
use App\Entity\Author;
use App\Repository\BooksRepository;

class BookController extends Controller
{
	/** @var integer */
    const BOOK_LIMIT = 5;

    /** @var string */
    const BOOK_TITLE_EBOOK = 'E-Books';

    /** @var string */
    const BOOK_TITLE_PAPER = 'Paper Books';

     /** @var string */
    const BOOK_TITLE       = 'All Books';

	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var \Doctrine\Common\Persistence\ObjectRepository */
	private $authorRepository;

	/** @var \Doctrine\Common\Persistence\ObjectRepository */
	private $bookRepository;

	/**
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
	    $this->entityManager    = $entityManager;
	    $this->bookRepository   = $entityManager->getRepository('App:Books');
	    $this->authorRepository = $entityManager->getRepository('App:Authors');
	}

    /**
     * @Route("/", name="homepage")
     */
    public function index(LoggerInterface $logger)
    {
		$logger->info('I just got the logger index');

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
	 * @Route("/", name="homepage")
	 * @Route("/entries", name="entries")
	 */
	public function entries(LoggerInterface $logger,Request $request)
	{

        $page = 1;

        if ($request->get('page')) 
        {
            $page = $request->get('page');
        }
        //Get filtered book list from DB
		$bookList = $this->bookRepository->getAllBooks($page, self::BOOK_LIMIT);
		// Render data
		 return $this->render('book/entries.html.twig', [
            'bookList' => $bookList,
            'page' => $page,
            'entryLimit' => self::BOOK_LIMIT,
            'pageTitle' => self::BOOK_TITLE
        ]);

	}

	  /**
	 * @Route("/books/{id}", name="books")
	 * @param $id
	 */
	public function books($id, LoggerInterface $logger,Request $request)
	{

        $page = 1;

        if ($request->get('page')) 
        {
            $page = $request->get('page');
        }

        //Get filtered book list from DB
		$bookList = $this->bookRepository->getAllBooksFiltered($page, self::BOOK_LIMIT, $id);

		//set page title
		switch ($id) 
		{
			case '1':
				$title = self::BOOK_TITLE_PAPER;
				break;
			case '2':
				$title = self::BOOK_TITLE_EBOOK;
				break;
			default:
				# code...
				break;
		}
		// Render data
		 return $this->render('book/entries.html.twig', [
            'bookList' => $bookList,
            'page' => $page,
            'entryLimit' => self::BOOK_LIMIT,
            'pageTitle'  => $title
        ]);

	}

	/**
	* @Route("/create-entry", name="create_book_entry")
	*
	* @param Request $request
	*
	* @return \Symfony\Component\HttpFoundation\Response
	*/
	public function createEntry(Request $request, LoggerInterface $logger)
	{
		//init book class
		$book = new Books();

		// //create form
		$form = $this->createForm(EntryFormType::class, $book);
  		$form->handleRequest($request);

	    // Check is valid
	    if ($form->isSubmitted() && $form->isValid()) 
	    {
		    //Book image
	        // $file stores the uploaded jpg file
	        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
	    	$file = $form->get('bookCover')->getData();

	        $fileName = md5(uniqid()).'.'.$file->guessExtension();

	        // moves the file to the directory where brochures are stored
	        $file->move(
	            $this->getParameter('cover_directory'),
	            $fileName
	        );
			
	        $book->setBookCover($fileName);
	        //get author id
	    	$author = $form->get('arrAuthor')->getData();
	    	//call insert book
			$bookList = $this->bookRepository->insertNewBook($book, $author);

	        $this->addFlash('success', 'Congratulations! Your book is created');

	        return $this->redirectToRoute('create_book_entry');
	    }

		    return $this->render('book/entry_form.html.twig', [
		        'form' => $form->createView(),
	            'pageTitle'  => 'Insert new book'

		    ]);
		}


	 /**
	 * @Route("/delete", name="delete")
	 * @param $id
	 */
	public function deleteBookView(LoggerInterface $logger,Request $request)
	{

        $page = 1;

        if ($request->get('page')) 
        {
            $page = $request->get('page');
        }

        //Get filtered book list from DB
		$bookList = $this->bookRepository->getAllBooks($page, self::BOOK_LIMIT);

		// Render data
		 return $this->render('book/delete.html.twig', [
            'bookList' => $bookList,
            'page' => $page,
            'entryLimit' => self::BOOK_LIMIT,
            'pageTitle'  => "Delete Book"
        ]);

	}


	 /**
	 * @Route("/delete-book/{id}", name="delete_book")
	 * @param $id
	 */
	public function deleteBook($id, LoggerInterface $logger,Request $request)
	{

        $em = $this->getDoctrine()->getEntityManager();
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        $em->remove($book);
        $em->flush();

	    return $this->redirectToRoute('delete');
		

	}
}
