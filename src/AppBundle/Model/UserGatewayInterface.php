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
     * Update user.
     */
    public function update();

    /**
     * @param User $user
     */
    public function remove(UserInterface $user);
}
