<?php

namespace App\Service;

use App\Entity\Creative;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\TraceableValidator;

class PublishAd
{

  private $entityManager;
  private $serializer;
  private $validator;

  public function __construct(EntityManager $entityManager, Serializer $serializer,TraceableValidator $validator)
  {
    $this->entityManager = $entityManager;
    $this->serializer=$serializer;
    $this->validator=$validator;
  }

private function editCreative(Creative $creative, $state){

  //check if creativ state is diferent from Publishing
  if ($creative->getState()!="Publishing"){
    $creative->setState($state);
  }
  //verify if the data on the creative object satisfies the constraints
  $errors = $this->validator->validate($creative);

  if (count($errors) > 0) {
    $errorsString = (string) $errors;
    throw new \Exception($errorsString);
  }

  return $creative;

}
public function publish(Creative $creative){
  //edit Creative
  try{
    $creative=$this->editCreative($creative,"Published");
  }catch (\Exception $e){
    return $e->getMessage();
  }

  //save the Creative
  $this->entityManager->persist($creative);
  //execute the queries
  $this->entityManager->flush();

  //serialize the creative into JSON
  $json = $this->serializer->serialize($creative, 'json');

  return $json;

}

}
