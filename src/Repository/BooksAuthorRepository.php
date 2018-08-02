<?php

namespace App\Repository;

use App\Entity\BooksAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BooksAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BooksAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BooksAuthor[]    findAll()
 * @method BooksAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksAuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BooksAuthor::class);
    }

   /**
    * @return BooksAuthor[] Returns an array of BooksAuthor objects
    */
    public function findAll()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('b')
            ->from('App:Authors', 'b');

        return $queryBuilder->getQuery()->getResult();
    }

  

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BooksAuthor
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
