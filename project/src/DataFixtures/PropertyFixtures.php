<?php

namespace App\DataFixtures;


use App\Entity\Property;
use App\DataFixtures\UserFixtures;
use App\Entity\Amenities;
use App\Entity\Detailsinformation;
use App\Entity\Gallery;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load (ObjectManager $manager):void 
    {

        $facker = \Faker\Factory::create();

        for ($i = 0; $i < 200; $i++)
        {

            $property = new Property();
            $property->setStatuts($this->getReference('category_'. rand(1,2) . '_' .rand(1, 2) ));

            $property->setAgentImmo($this->getReference('agent'));

            $random = rand(0,1);
            if ($random == 0 )
            {
                $details = new Detailsinformation();
                $details -> setAreaSize($facker->randomFloat(2,10, 100));
                $details -> setSizePrefix('m²');
                $details -> setLandArea($facker ->randomFloat(2,10,100));
                $details -> setBedroom($facker->randomDigitNotNull());
                $details -> setBathrooms($facker->randomDigitNotNull());
                $details -> setGarages($facker->randomDigitNotNull());
                $details -> setYearBuild($facker->dateTimeBetween('-50 years', 'now'));

                $manager->persist($details);
                
            } else { 
                $details = null;
            }
            $property->setDetailsInformation($details);

            $property->setLang($facker->randomElement(['fr','en','ru']));
            $property->setPropertyTitle($facker->sentence(6));
            $property->setDescription($facker->text(200));
            $property->setPrice($facker->randomFloat(0,10, 100));
            $property->setArea($facker->randomFloat(3,10, 100));
            $property->setSlug( $facker->slug);

            $manager->persist($property);
            

            for ($j = 1; $j<rand(1,5) ; $j++)
            {
                $img = rand(1,50) . '.jpg';
                $image = file_get_contents('https://loremflickr.com/905/584/house');

                if (!file_exists('C:/laragon/www/cityscape/project/public/assets/images/bienimmo/' . $img))
                {
                    file_put_contents('C:/laragon/www/cityscape/project/public/assets/images/bienimmo/' . $img, $image);
                }

                $gallerie = new Gallery();
                $gallerie->setImageName($img);
                $gallerie->setProperty($property);
                $gallerie->setCreatedAt(new \DateTimeImmutable());
                $manager->persist($gallerie);
            }

            $amenitiesrand = rand(0,1);
            if ($amenitiesrand ==1){
                for ($k = 0; $k<rand(1,5); $k++){
                    $amenities = new Amenities();
                    $amenities ->setName($facker->sentence(6));
                    $amenities ->setProperty($property);
                    $manager ->persist($amenities);
                }
            }

            
        }
        $manager->flush();
    }
    
    
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}