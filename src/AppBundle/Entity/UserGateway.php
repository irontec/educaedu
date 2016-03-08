<?php

namespace AppBundle\Entity;

use AppBundle\Model\UserGatewayInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Model\UserInterface;

/**
 * UserGateway.
 */
class UserGateway extends EntityRepository implements UserGatewayInterface
{
    /**
     * @param User $user
     *
     * @return User
     */
    public function apiInsert(UserInterface $user)
    {
        $user
            ->setEnabled(true)
            ->setExpired(false)
            ->setLocked(false)
            ->addRole('read')
            ->addRole('edit')
            ->addRole('ROLE_USER')
            ->addRole('ROLE_API_USER')
        ;

        return self::insert($user);
    }

    /**
     * @return type
     */
    public function findNew()
    {
        return User::fromArray();
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function insert(UserInterface $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();

        return $user;
    }

    /**
     * Update user.
     */
    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param User $user
     */
    public function remove(UserInterface $user)
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }
}
