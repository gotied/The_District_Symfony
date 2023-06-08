<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function top6cat(): array
    {
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery('
        SELECT COALESCE(ventes.totalVentes, 0) AS nbrVente, cat.libelle, cat.image, cat.id
        FROM App\Entity\Categorie cat
        LEFT JOIN (
            SELECT COUNT(*) AS totalVentes, p.idCategorie
            FROM App\Entity\Commande c
            JOIN App\Entity\Plat p WITH p.id = c.plat
            GROUP BY p.idCategorie
        ) AS ventes ON cat.id = ventes.idCategorie
        WHERE cat.active = :active
        ORDER BY nbrVente DESC
        LIMIT 6');

        $query->setParameter('active', 'yes');

        $result = $query->getResult();
        return $result;
    }
}
