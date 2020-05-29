<?php

namespace App\Security;

use App\Entity\Item;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ItemVoter extends Voter
{
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::DELETE]))
        {
            return false;
        }

        if (!$subject instanceof Item) 
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
         * @var Item $item
         */
        $item = $subject;

        return $item->getUser()->getId() === $authenticatedUser->getId();

    }
}
