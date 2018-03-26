<?php

namespace App\Security\User;

use App\Entity\User\User;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CurrentUser implements AdvancedUserInterface, EquatableInterface
{
    private $id;

    private $username;

    private $email;

    private $verifiedMobile;

    private $password;

    private $roles;

    private $isActive;

    private $createdAt;

    private $updatedAt;

    private $userProfile;

    /**
     * CurrentUser constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->verifiedMobile = $user->getVerifiedMobile();
        $this->password = $user->getPassword();
        $this->roles = $user->getRoles();
        $this->isActive = $user->getIsActive();
        $this->createdAt = $user->getCreatedAt();
        $this->updatedAt = $user->getUpdatedAt();
        $this->userProfile = $user->getUserProfile();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getVerifiedMobile()
    {
        return $this->verifiedMobile;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getUserProfile()
    {
        return $this->userProfile;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
        return $this->isActive;
    }

    public function isLogin()
    {
        return empty($this->id) ? false : true;
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof self) {
            return false;
        }

        if ($this->getPassword() !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}