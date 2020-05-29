<?php

namespace App\Security;

use App\Entity\Bundle;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BundleVoter extends Voter
{
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::DELETE]))
        {
            return false;
        }

        if (!$subject instanceof Bundle) 
        {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $authenticatedUser = $token->getUser();

        if (!$authenticatedUser instanceof User)
        {
            return false;
        }

        /**
         * @var Bndle $bundle
         */
        $bundle = $subject;

        return $bundle->getUser()->getId() === $authenticatedUser->getId();

    }
}
