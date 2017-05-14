<?php
namespace project\GameHubBundle\Repository;

use Doctrine\ORM\EntityRepository;
class JeuxRepository extends EntityRepository
{
    public function searchTitreDQL($titre)
    {
        $query=$this->getEntityManager()->createQuery("Select j from projectGameHubBundle:Jeux j WHERE j.nom LIKE :titre")->setParameter('titre','%'.$titre.'%');
        return $query->getResult();

    }

//    public function searchTitreResDQL($titre)
//    {
//        $query=$this->getEntityManager()->createQuery("Select COUNT(j) from projectGameHubBundle:Jeux j WHERE j.nom LIKE :titre")->setParameter('titre','%'.$titre.'%');
//        return $query->getResult();
//
//    }
    public function searchTitreGenreDQL($titre,$genre)
    {
        $query=$this->getEntityManager()->createQuery("Select j from projectGameHubBundle:Jeux j WHERE j.nom LIKE :titre AND j.genre=:genre")->setParameters(array(':titre'=>'%'.$titre.'%',':genre'=>$genre));
        return $query->getResult();

    }


}