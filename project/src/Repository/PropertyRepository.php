<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Property>
 *
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * return Property
     */
    public function findPropertyByCategory($souscategory,$category)
    {
            // creation de query Builder
            return $this->createQueryBuilder('p')
                // jointure avec la table category
                ->innerJoin('p.statuts', 'c')
                // selection de la categorie
                ->andWhere('c.slug = :souscategory')
                // parametre de la categorie
                ->setParameter('souscategory', $souscategory)
                // jointure de la sous categorie
                ->innerJoin('c.parent', 's')
                // selection de la sous categorie
                ->andWhere('s.slug = :category')
                // parametre de la sous categorie
                ->setParameter('category', $category)
                // retourne la requete
                ->getQuery()
                 // retourne le resultat
                ->getResult();
    }
}
