<?php

namespace App\Repository;

use App\Entity\Detail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detail>
 *
 * @method Detail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detail[]    findAll()
 * @method Detail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detail::class);
    }

    public function save(Detail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Detail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Detail[] Returns an array of Detail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Detail
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function top6cat(): array
{
    $queryBuilder = $this->createQueryBuilder('d');

    $queryBuilder
        ->select('count(cmm.id) AS nbr_vente, c.id, c.libelle, c.image')
        ->leftJoin('d.plat', 'p')
        ->leftJoin('p.categorie', 'c')
        ->leftJoin('d.commande', 'cmm')
        ->where('c.active = :active')
        ->setParameter('active', true)
        ->groupBy('p.id')
        ->orderBy('nbr_vente', 'DESC')
        ->setMaxResults(6);

    $result = $queryBuilder->getQuery()->getResult();

    // dd($result);
    return $result;
}

public function top3plat(): array {
    $queryBuilder = $this->createQueryBuilder('d');

    $queryBuilder
        ->select('count(p.id) AS nbr_vente, p.libelle, p.image')
        ->leftJoin('d.plat', 'p')
        ->leftJoin('d.commande', 'c')
        ->where('c.etat = :etat')
        ->setParameter('etat', 3)
        ->groupBy('p.id')
        ->orderBy('nbr_vente', 'DESC')
        ->setMaxResults(3);

    $result = $queryBuilder->getQuery()->getResult();
    return $result;
}
}
