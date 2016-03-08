<?php

namespace AppBundle\Model;

/**
 * UserRepository.
 */
class UserRepository
{
    /**
     * @var \AppBundle\Model\UserGatewayInterface
     */
    private $gateway;

    /**
     * @var \AppBundle\Model\UserFactoryInterface
     */
    private $factory;

    /**
     * @param \AppBundle\Model\UserGatewayInterface $gateway
     * @param \AppBundle\Model\UserFactoryInterface $factory
     */
    public function __construct(UserGatewayInterface $gateway, UserFactoryInterface $factory)
    {
        $this->gateway = $gateway;
        $this->factory = $factory;
    }

    /**
     * @param User|int $id
     *
     * @return User
     */
    public function find($id)
    {
        return $this->gateway->find($id);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $users = $this->gateway->findAll();

        return null === $users ? array() : $this->factory->makeAll($users);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     * @param int   $limit
     * @param int   $offset
     *
     * @return array
     */
    public function findBy(array $criteria = array(), array $orderBy = array('created_at' => 'ASC'), $limit = null, $offset = null)
    {
        $users = $this->gateway->findBy($criteria, $orderBy, $limit, $offset);

        return null === $users ? array() : $this->factory->makeAll($users);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     *
     * @return User
     *
     * @throws NotFoundHttpException
     */
    public function findOneBy(array $criteria, array $orderBy = array())
    {
        $user = $this->gateway->findOneBy($criteria, $orderBy);

        if (null === $user) {
            return null;
        }

        return $this->factory->makeOne($user);
    }

    /**
     * @return User
     */
    public function findNew()
    {
        return $this->gateway->findNew();
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function insert(UserInterface $user)
    {
        $rawUser = $this->gateway->apiInsert($user);

        return $this->factory->makeOne($rawUser);
    }

    /**
     * 
     */
    public function update()
    {
        return $this->gateway->update();
    }

    /**
     * @param User $user
     */
    public function remove(UserInterface $user)
    {
        $this->gateway->remove($user);
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function parse(UserInterface $user)
    {
        return $this->factory->makeOne($user);
    }
}
