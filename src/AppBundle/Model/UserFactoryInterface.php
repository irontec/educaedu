<?php

namespace AppBundle\Model;

interface UserFactoryInterface
{
    /**
     * @param \AppBundle\Entity\User $rawUser
     *
     * @return \AppBundle\Entity\User
     */
    public function makeOne(UserInterface $rawUser);

    /**
     * @param array $rawUsers
     *
     * @return array
     */
    public function makeAll(array $rawUsers);

    /**
     * @param \AppBundle\Entity\User $rawUser
     *
     * @return \AppBundle\Entity\User
     */
    public function make(UserInterface $rawUser);
}
