<?php

namespace App\Repository;

use App\Entity\FilmShowTakenSeat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FilmShowTakenSeat>
 *
 * @method FilmShowTakenSeat|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmShowTakenSeat|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmShowTakenSeat[]    findAll()
 * @method FilmShowTakenSeat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmShowTakenSeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmShowTakenSeat::class);
    }

    public function save(FilmShowTakenSeat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FilmShowTakenSeat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FilmShowTakenSeat[] Returns an array of FilmShowTakenSeat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FilmShowTakenSeat
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
