<?php

namespace App\Repository;

use App\Entity\Plat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Plat>
 *
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }

    public function save(Plat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Plat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Plat[] Returns an array of Plat objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Plat
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function allplat()
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder
            ->where('p.active = :active')
            ->setParameter('active', true)
            ->orderBy('p.id', 'ASC');

        $query = $queryBuilder->getQuery();
        $result = $query->getResult();

        return $result;
    }

    public function PlatParCat($id)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder
            ->join('p.categorie', 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.id', 'ASC');

        $query = $queryBuilder->getQuery();
        $result = $query->getResult();

        return $result;
    }

    public function PlatPanier() 
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('pl')
           ->from(Plat::class, 'pl');
    
        $query = $qb->getQuery();
        $result = $query->getArrayResult();
    
        return $result;
    }
}
