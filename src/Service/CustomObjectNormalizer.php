<?php

namespace App\Service;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class CustomObjectNormalizer extends ObjectNormalizer
{
  public function __construct(){

    parent::__construct();

    $this->setCircularReferenceHandler(function ($object) {
      return $object->getId();
    });
  }
}
