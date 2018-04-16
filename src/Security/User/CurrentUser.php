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

    private $isEnabled;

    private $isLocked;

    private $createdAt;

    private $updatedAt;

    private $userProfile;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->verifiedMobile = $user->getVerifiedMobile();
        $this->password = $user->getPassword();
        $this->roles = $user->getRoles();
        $this->isEnabled = $user->getIsEnabled();
        $this->createdAt = $user->getCreatedAt();
        $this->updatedAt = $user->getUpdatedAt();
        $this->userProfile = $user->getUserProfile();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getVerifiedMobile()
    {
        return $this->verifiedMobile;
    }

    /**
     * @param mixed $verifiedMobile
     */
    public function setVerifiedMobile($verifiedMobile): void
    {
        $this->verifiedMobile = $verifiedMobile;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param mixed $isEnabled
     */
    public function setIsEnabled($isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return mixed
     */
    public function getisLocked()
    {
        return $this->isLocked;
    }

    /**
     * @param mixed $isLocked
     */
    public function setIsLocked($isLocked): void
    {
        $this->isLocked = $isLocked;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * @param mixed $userProfile
     */
    public function setUserProfile($userProfile): void
    {
        $this->userProfile = $userProfile;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return !$this->isLocked;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->getIsEnabled();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
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