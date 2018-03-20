<?php

namespace App\Security\Voter\User;

use App\Entity\User\User;
use App\Security\User\CurrentUser;
use App\Security\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return \in_array($attribute, ['EDIT', 'VIEW']) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $currentUser = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$currentUser instanceof CurrentUser) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                // logic to determine if the user can EDIT
                // return true or false
                return $this->canEdit($subject, $token);
            case 'VIEW':
                // logic to determine if the user can VIEW
                // return true or false
                return $this->canView($subject, $token);
        }

        return false;
    }

    /**
     * @param User $subject
     * @param TokenInterface $token
     * @return bool
     */
    public function canView($subject, $token): bool
    {
        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }

        if ($token->getUser()->getId() === $subject->getId()) {
            return true;
        }

        return $subject->isEnabled();
    }

    /**
     * @param User $subject
     * @param TokenInterface $token
     * @return bool
     */
    private function canEdit($subject, $token): bool
    {
        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }

        if ($subject->isEnabled() && $token->getUser()->getId() === $subject->getId()) {
            return true;
        }

        return false;
    }
}
