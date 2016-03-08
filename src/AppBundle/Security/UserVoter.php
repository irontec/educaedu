<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AppBundle\Model\UserInterface;

class UserVoter extends Voter
{
    const EDIT = 'edit';
    const VIEW = 'view';

    public function supports($attribute, $subject)
    {
        return $subject instanceof UserInterface && in_array($attribute, array(
              self::VIEW, self::EDIT,
        ));
    }

    protected function voteOnAttribute($attribute, $currentUser, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        $roles = $user->getRoles();

        if (
            in_array(strtoupper(self::EDIT), $roles) &&
            $attribute == self::EDIT &&
            $user->getEmail() == $currentUser->getEmail()
        ) {
            return true;
        }

        if (
            in_array('ROLE_USER', $roles) &&
            $attribute == self::VIEW &&
            $user->getEmail() === $currentUser->getEmail()
        ) {
            return true;
        }

        return false;
    }
}
