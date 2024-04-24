<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category= [
            1 => [
                'name' => 'Vente',
                'lang' => 'fr',
                'description' => 'Vente de biens immobiliers',
                'slug' => 'vente',
                'parent' => [
                    1 => [
                        'name' => 'Maison',
                        'lang' => 'fr',
                        'description' => 'Vente de maisons',
                        'slug' => 'maison',
                    ],
                    2 => [
                        'name' => 'Appartement',
                        'lang' => 'fr',
                        'description' => 'Vente d\'appartements',
                        'slug' => 'appartement',
                    ],
                    
                ],

            ],
            2 => [
                'name' => 'Location',
                'lang' => 'fr',
                'description' => 'Location de biens immobiliers',
                'slug' => 'location',
                'parent' => [
                    1 => [
                        'name' => 'Maison',
                        'lang' => 'fr',
                        'description' => 'Location de maisons',
                        'slug' => 'maison',
                    ],
                    2 => [
                        'name' => 'Appartement',
                        'lang' => 'fr',
                        'description' => 'Location d\'appartements',
                        'slug' => 'appartement',
                    ],
                    3 => [
                        'name' => 'Local commercial',
                        'lang' => 'fr',
                        'description' => 'Location de locaux commerciaux',
                        'slug' => 'local-commercial',
                    ],
                ]
            ],

            // anglais
            3 => [
                'name' => 'Sale',
                'lang' => 'en',
                'description' => 'Sale of real estate',
                'slug' => 'sale',
                'parent' => [
                    1 => [
                        'name' => 'House',
                        'lang' => 'en',
                        'description' => 'Sale of houses',
                        'slug' => 'house',
                    ],
                    2 => [
                        'name' => 'Apartment',
                        'lang' => 'en',
                        'description' => 'Sale of apartments',
                        'slug' => 'apartment',
                    ],
                ],

            ],
            4 => [
                'name' => 'Rental',
                'lang' => 'en',
                'description' => 'Rental of real estate',
                'slug' => 'rental',
                'parent' => [
                    1 => [
                        'name' => 'House',
                        'lang' => 'en',
                        'description' => 'Rental of houses',
                        'slug' => 'house',
                    ],
                    2 => [
                        'name' => 'Apartment',
                        'lang' => 'en',
                        'description' => 'Rental of apartments',
                        'slug' => 'apartment',
                    ],
                    3 => [
                        'name' => 'Commercial premises',
                        'lang' => 'en',
                        'description' => 'Rental of commercial premises',
                        'slug' => 'commercial-premises',
                    ],
                ]
            ],

            // russe
            5 => [
                'name' => 'Продажа',
                'lang' => 'ru',
                'description' => 'Продажа недвижимости',
                'slug' => 'prodazha',
                'parent' => [
                    1 => [
                        'name' => 'Дом',
                        'lang' => 'ru',
                        'description' => 'Продажа домов',
                        'slug' => 'dom',
                    ],
                    2 => [
                        'name' => 'Квартира',
                        'lang' => 'ru',
                        'description' => 'Продажа квартир',
                        'slug' => 'kvartira',
                    ],
                ],

            ],

            6 => [
                'name' => 'Аренда',
                'lang' => 'ru',
                'description' => 'Аренда недвижимости',
                'slug' => 'arenda',
                'parent' => [
                    1 => [
                        'name' => 'Дом',
                        'lang' => 'ru',
                        'description' => 'Аренда домов',
                        'slug' => 'dom',
                    ],
                    2 => [
                        'name' => 'Квартира',
                        'lang' => 'ru',
                        'description' => 'Аренда квартир',
                        'slug' => 'kvartira',
                    ],
                    3 => [
                        'name' => 'Коммерческие помещения',
                        'lang' => 'ru',
                        'description' => 'Аренда коммерческих помещений',
                        'slug' => 'kommercheskie-pomescheniya',
                    ],
                ]
            ],
        ];

        foreach ($category as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setSlug($value['slug']);
            $category->setLang($value['lang']);
            $this->addReference('category_' . $key, $category); // category_1, category_2
            $manager->persist($category);
            if (isset($value['parent'])) {
                foreach ($value['parent'] as $k => $v) {
                    $parent = new Category();
                    $parent->setName($v['name']);
                    $parent->setSlug($v['slug']);
                    $parent->setLang($v['lang']);
                    $parent->setParent($category);
                    $manager->persist($parent);
                    $this->setReference('category_' . $key . '_' . $k, $parent);
                }
            }
        }

        $manager->flush();
    }
}
