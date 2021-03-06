<?php

namespace Club\TournamentBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TournamentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournamentRepository extends EntityRepository
{
  public function isAttending(\Club\TournamentBundle\Entity\Tournament $tournament, \Club\UserBundle\Entity\User $user)
  {
    return $this->_em->createQueryBuilder()
      ->select('t')
      ->from('ClubTournamentBundle:Tournament', 't')
      ->leftJoin('t.attends', 'a')
      ->where('t.id = :tournament')
      ->andWhere('a.user = :user')
      ->setParameter('tournament', $tournament->getId())
      ->setParameter('user', $user->getId())
      ->getQuery()
      ->getOneOrNullResult();
  }
}
