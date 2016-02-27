<?php

namespace ComakeitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ComakeitBundle\Entity\Symptoms;

class LoadSymptomsData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $symptoms = [
        ['conditions' => 'coughing'],
        ['conditions' => 'shortness of breath'],
        ['conditions' => 'tiredness'],
        ['conditions' => 'weight loss'],
        ['conditions' => 'Pain'],
        ['conditions' => 'Vomiting'],
        ['conditions' => 'Feel tired or lightheaded'],
        ['conditions' => 'Have decreased energy'],
        ['conditions' => 'Appear pale'],
        ['conditions' => 'palpitations'],
        ['conditions' => 'sweating'],
        ['conditions' => 'feelings of stress'],
        ['conditions' => 'sneezing'],
        ['conditions' => 'cough'],
        ['conditions' => 'fever'],
        ['conditions' => 'Joint pain'],
        ['conditions' => 'palpitations'],
        ['conditions' => 'sweating'],
        ['conditions' => 'feelings of stress'],
        ['conditions' => 'sneezing'],
        ['conditions' => 'cough'],
        ['conditions' => 'fever'],
        ['conditions' => 'Joint pain']
    ];
    foreach ($symptoms as $index => $symptom) {
      $indexNew = (int)($index/2);
      $symptomEntity = new Symptoms();
      $symptomEntity->setConditions($symptom['conditions']);
      $symptomEntity->setDisease($this->getReference('d-'.$indexNew));
      $manager->persist($symptomEntity);
    }

    $manager->flush();
  }

  public function getOrder() {
    return 3;
  }

}
