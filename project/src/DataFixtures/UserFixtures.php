<?php

namespace App\DataFixtures;

use Facker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $facker = \Faker\Factory::create('fr_FR');

        // Creation Admin User
        for($i = 0; $i < 3; $i++){
            $admin = new User();
            $admin->setEmail($facker->email);
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'admin')); 
            $admin->setIsVerified(true);
            $admin->setLastName($facker->lastName);
            $admin->setFirstName($facker->firstName);
            $admin->setUserName($facker->userName);
            $manager->persist($admin);
        }

        // Creation Agent Immobiliger
        for($j = 0; $j < 10; $j++){
            $agent = new User();
            $agent->setEmail($facker->email);
            $agent->setRoles(['ROLE_AGENT']);
            $agent->setPassword($this->userPasswordHasher->hashPassword($agent, 'agent')); 
            $agent->setIsVerified(true);
            $agent->setLastName($facker->lastName);
            $agent->setFirstName($facker->firstName);
            $agent->setUserName($facker->userName);
            $this->setReference('agent', $agent) ;
            $manager->persist($agent);
        }
        


        // Creation User
        for($k = 0; $k < 50; $k++){
            $user = new User();
            $user->setEmail($facker->email);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, 'user')); 
            $user->setIsVerified(true);
            $user->setLastName($facker->lastName);
            $user->setFirstName($facker->firstName);
            $user->setUserName($facker->userName);
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
