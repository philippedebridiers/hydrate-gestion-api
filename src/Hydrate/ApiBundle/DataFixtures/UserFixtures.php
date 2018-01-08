<?php
/**
 * Created by PhpStorm.
 * User: pdebridiers
 * Date: 04/01/2018
 * Time: 15:35
 */

namespace Hydrate\ApiBundle\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Hydrate\ApiBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $password = $this->encoder->encodePassword($user, 'test1234');
        $user->setPassword($password);
        $user->setIsActive(true);
        $user->setEmail('philippedebridiers@hotmail.com');
        $manager->persist($user);
        $manager->flush();
    }
}