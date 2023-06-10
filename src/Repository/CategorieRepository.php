<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 *
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function save(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Categorie[] Returns an array of Categorie objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Categorie
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /*public function top6cat(EntityManagerInterface $entityManager): array
{
    $queryBuilder = $entityManager->createQueryBuilder();

    $queryBuilder
        ->select('COUNT(p.id) AS nbr_vente', 'categorie.libelle', 'categorie.image', 'categorie.id')
        ->from('App\Entity\Categorie', 'categorie')
        ->leftJoin('categorie.plats', 'p')
        ->leftJoin('p.details', 'd')
        ->leftJoin('d.commande', 'commande')
        ->where('categorie.active = :active')
        ->setParameter('active', 'true')
        ->groupBy('p.id')
        ->orderBy('nbr_vente', 'DESC')
        ->setMaxResults(6);

    $result = $queryBuilder->getQuery()->getResult();

    dd($result);
    return $result;
}*/
}
