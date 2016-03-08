<?php

namespace AppBundle\Model;

class UserFactory implements UserFactoryInterface
{
    /**
     * @param \AppBundle\Entity\User $rawUser
     *
     * @return \AppBundle\Entity\User
     */
    public function makeOne(UserInterface $rawUser)
    {
        return $this->make($rawUser);
    }

    /**
     * @param array $rawUsers
     *
     * @return array
     */
    public function makeAll(array $rawUsers)
    {
        foreach ($rawUsers as $rawUser) {
            $users[$rawUser->getId()] = $this->make($rawUser);
        }

        return $users;
    }

    /**
     * @param \AppBundle\Entity\User $rawUser
     *
     * @return \AppBundle\Entity\User
     */
    public function make(UserInterface $rawUser)
    {
        // You can format object, in this case we left it to return as raw object, feedback is welcome!
        return $rawUser;
    }
}
