<?php

namespace ComakeitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ComakeitBundle\Entity\Disease;

class LoadDiseaseData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $diseases = [
        ['name' => 'Asthma'],
        ['name' => 'Diabetes'],
        ['name' => 'Hernia'],
        ['name' => 'Anemia'],
        ['name' => 'Anxiety'],
        ['name' => 'Blood Clot'],
        ['name' => 'Cancer'],
        ['name' => 'Common Cold'],
        ['name' => 'Dengue'],
        ['name' => 'Systemic Lupus Erythematosus'],
        ['name' => 'Leukemia'],
        ['name' => 'Kidney Stone']
    ];
    foreach ($diseases as $index => $disease) {

      $diseaseEntity = new Disease();
      $diseaseEntity->setName($disease['name']);
      $this->addReference('d-' . $index, $diseaseEntity);
      $manager->persist($diseaseEntity);
    }

    $manager->flush();
  }

  public function getOrder() {
    return 2;
  }

}
