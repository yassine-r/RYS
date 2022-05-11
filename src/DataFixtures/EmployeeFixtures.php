<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmployeeFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new Employee();
        $user->setNom('yassine2021');
        $user->setPrenom('yassine2021');
        $user->setEmail('yassine2021');
        $user->setCin('yassine2021');
        $user->setCnss('yassine2021');
        $user->setPhone('yassine2021');
        $user->setAdresse('yassine2021');
        $user->setSexe('Man');
        $user->setRib('yassine2021');
        $user->setNombanque('yassine2021');
        $user->setStatue('yassine2021');
        $user->setSalaire('yassine2021');
        $user->setTypecontrat('yassine2021');
        $user->setEtat('yassine2021');
        $user->setProfile('yassine2021');
        $user->setCv('yassine2021');
        $user->setUsername('yassine2021');
        $user->setRoles('ROLE_ADMIN');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'yassine123'
            )
        );
        $manager->persist($user);
        $manager->flush();
    }
}
