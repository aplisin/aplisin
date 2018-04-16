<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Validator\Constraints as AppAssert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"username", "email"})
 * @ApiResource()
 */
class User implements AdvancedUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @AppAssert\Username()
     * @Assert\Length(min="4", max="32")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(min="6", max="64")
     */
    private $email;

    /**
     * @ORM\Column(name="verified_mobile", type="integer", length=32, unique=true, nullable=true)
     * @AppAssert\Mobile()
     */
    private $verifiedMobile;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="6", max="18")
     */
    private $password;

    /**
     * @ORM\Column(type="simple_array", length=255, nullable=true)
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\Column(name="is_enabled", type="boolean", nullable=true, options={"default":true})
     */
    private $isEnabled = true;

    /**
     * @ORM\Column(name="is_locked", type="boolean", nullable=true, options={"default":false})
     */
    private $isLocked = false;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User\UserProfile", inversedBy="user")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id", unique=true)
     * @ApiSubresource
     */
    private $userProfile;

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
    public function getIsLocked()
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
}