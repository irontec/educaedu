<?php

namespace AppBundle\Model;

/**
 * UserGateway.
 */
interface UserGatewayInterface
{

    /**
     * @param User $user
     *
     * @return User
     */
    public function apiInsert(UserInterface $user);

    /**
     * @return type
     */
    public function findNew();

    /**
     * @param User $user
     *
     * @return User
     */
    public function insert(UserInterface $user);
    /**
     * @param $id
     */
    public function remove($id);
}
