<?php

namespace App\Security\User;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CurrentUser implements AdvancedUserInterface, EquatableInterface
{
    private $currentUser;

    public function __construct(UserInterface $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    public function isEqualTo(UserInterface $currentUser)
    {
        if (!$currentUser instanceof CurrentUser) {
            return false;
        }

        if ($this->getPassword() !== $currentUser->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $currentUser->getSalt()) {
            return false;
        }

        if ($this->getUsername() !== $currentUser->getUsername()) {
            return false;
        }

        return true;
    }

    public function getRoles()
    {
        return $this->currentUser->getRoles();
    }

    public function getPassword()
    {
        return $this->currentUser->getPassword();
    }

    public function getSalt()
    {
        return $this->currentUser->getSalt();
    }

    public function getUsername()
    {
        return $this->currentUser->getUsername();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}