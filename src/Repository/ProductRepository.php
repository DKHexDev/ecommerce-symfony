<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Récupérer les produits les moins chers à partir de 200 euros.
     * 
     * @param int $price
     * @param int $limit
     * @return array
     */
    public function findByCheapPriceAtLeast($price = 200, $limit = null)
    {
        $qb = $this->createQueryBuilder('p'); // SELECT * FROM product p

        if ($limit)
        {
            $qb->setMaxResults($limit); // LIMIT
        }

        return $qb
            ->where('p.price > :price') // WHERE price > :price
            ->setParameter(':price', $price) // bindValue('price', $price)
            ->orderBy('p.price', 'ASC') // ORDER BY p.price ASC
            ->getQuery() // execute()
            ->getResult(); // fetchAll()
    }

    /**
     * Permet de récupére les produits avec une jointure sur les catégories
     * Pour optimiser le nombre de requêtes...
     * 
     * @return array
     */
    public function findAllWithJoin()
    {
        return $this->createQueryBuilder('p')
            ->addSelect('c')
            ->join('p.category', 'c')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
