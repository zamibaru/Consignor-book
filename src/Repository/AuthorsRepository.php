<?php

namespace App\Repository;

use App\Entity\Authors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Authors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authors[]    findAll()
 * @method Authors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Authors::class);
    }

    /**
    * @return Author[] Returns an array of BooksAuthor objects
    */
    public function getAllAuthorsReturnArray()
    {
        //init variables
        $returnArray = array();
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        //build query
        $queryBuilder
            ->select('b')
            ->from('App:Authors', 'b');
        //get response
        $response = $queryBuilder->getQuery()->getResult();
        //parse response and asign it to response array
        foreach ($response as $key => $author) 
        {
            $returnArray[$author->getAuthorFirstName().' '.$author->getAuthorLastName()] = $author->getAuthorId()  ;
        }
            
        return $returnArray;
    }


    /*
    public function findOneBySomeField($value): ?Authors
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
