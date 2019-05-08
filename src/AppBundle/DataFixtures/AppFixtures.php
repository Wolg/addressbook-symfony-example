<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $person = new Person();
            $person->setFirstName($faker->firstName);
            $person->setLastName($faker->lastName);
            $person->setAddress($faker->address);
            $person->setZip($faker->postcode);
            $person->setCity($faker->city);
            $person->setCountry($faker->country);
            $person->setBirthday($faker->dateTimeBetween('-100 years', 'now'));
            $person->setEmail($faker->email);
            $person->setPhoneNumber($faker->phoneNumber);
            $manager->persist($person);
        }

        $manager->flush();
    }
}