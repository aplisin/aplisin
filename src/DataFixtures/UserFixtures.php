<?php
namespace App\DataFixtures;
use App\Entity\User\User;
use App\Entity\User\UserProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@test.com');
            $password = $this->encoder->encodePassword($user, '123456');
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $userProfile = new UserProfile();
            $user->setUserProfile($userProfile);
            $manager->persist($user);
            $manager->persist($userProfile);
        }
        $manager->flush();
        $manager->clear();
    }
}