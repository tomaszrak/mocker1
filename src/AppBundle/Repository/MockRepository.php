<?php
/**
 * Created by PhpStorm.
 * User: kgurgul
 * Date: 2015-10-19
 * Time: 18:26
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Mock;
use Doctrine\ORM\EntityRepository;

class MockRepository extends EntityRepository
{
    public function getMockByUrl($mockUrl)
    {
        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('m')
            ->from('AppBundle:Mock', 'm')
            ->leftJoin('m.headers', 'h')
            ->where('m.url = :url')
            ->setMaxResults(1)
            ->setParameter(':url', $mockUrl)
            ->getQuery()
            ->execute();

        if ($result != null) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function saveMock(Mock $mock)
    {
        $this->getEntityManager()->persist($mock);
        $this->getEntityManager()->flush();
    }
}