<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Psr\Log\LoggerInterface;

/**
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    private $logger;
    public function __construct(RegistryInterface $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Books::class);
        $this->logger = $logger;
    }

    /**
    * @param int $page
    * @param int $limit
    * Method gets all books from database taking in account that it has an author set
    * Method also handles pagination
    * @return array
    */
    public function getAllBooks($page = 1, $limit = 5)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('b')
            ->from('App:Books', 'b')
            ->innerJoin('b.arrAuthor', 'ba')
            ->orderBy('b.bookTitle', 'DESC')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);
        return $queryBuilder->getQuery()->getResult();
    }

    /**
    * @param int $page
    * @param int $limit
    * Method gets all books from database taking in account that it has an author set and filters after book type (Paper(1),Ebook(2)) - default is papaer
    * Method also handles pagination
    * @return array
    */
    public function getAllBooksFiltered($page = 1, $limit = 5, $id = 1)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('b')
            ->from('App:Books', 'b')
            ->innerJoin('b.arrAuthor', 'ba')
             ->andWhere('b.bookType = :searchTerm')
             ->setParameter('searchTerm', $id)
            ->orderBy('b.bookTitle', 'DESC')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);
        return $queryBuilder->getQuery()->getResult();
    }

    /**
    * @param int $page
    * @param int $limit
    * Method gets all books from database taking in account that it has an author set and filters after book type (Paper(1),Ebook(2)) - default is papaer
    * Method also handles pagination
    * @return array
    */
    public function insertNewBook(Books $book, $authorId)
    {

       
        $this->logger->info('getAllBooksFiltered');
        //asign variables
        $strBookID    = $book->getBookID();
        $strBookTitle = $book->getBookTitle();
        $strBookType  = $book->getBookType();
        $strBookCover = $book->getBookCover();
        $strBookDescription = $book->getBookDescription();
        //get DB connection
        $entityManager = $this->getEntityManager();
        $connection = $entityManager->getConnection();
        //write query
        $statement = $connection->prepare("INSERT INTO books (`book_id`, `book_title`, `book_cover`, `book_type`, `book_description`) VALUES (:id,:title,:cover,:type,:description)");
        $statement->bindValue('id',$strBookID);
        $statement->bindValue('title',$strBookTitle);
        $statement->bindValue('cover',$strBookCover);
        $statement->bindValue('type',$strBookType);
        $statement->bindValue('description',$strBookDescription);
        $statement->execute();

        //insert in books_author
        $statement = $connection->prepare("INSERT INTO `books_author`(`book_id`, `author_id`) VALUES (:bookId,:authorId)");
        $statement->bindValue('bookId',$strBookID);
        $statement->bindValue('authorId',$authorId);
        $statement->execute();


       return false;
    }

    

}
