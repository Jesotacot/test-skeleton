<?php

namespace App\Service;

use App\Entity\Creative;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\TraceableValidator;

class PublishAd {

    private $entityManager;
    private $serializer;
    private $validator;

    /**
     * 
     * @param EntityManager $entityManager
     * @param Serializer $serializer
     * @param TraceableValidator $validator
     */
    public function __construct(EntityManager $entityManager, Serializer $serializer, TraceableValidator $validator) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * 
     * @param Creative $creative
     * @param string $state
     * @return Creative
     * @throws \Exception
     */
    private function editCreative(Creative $creative, $state) {
        //check if creativ state is diferent from Publishing
        if ($creative->getState() != "Publishing") {
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

    /**
     * Publish a creative
     * 
     * @param Creative $creative
     * @return array
     */
    public function publish(Creative $creative) {
        //edit Creative
        try {
            $edited = $this->editCreative($creative, "Published");
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        //save the Creative
        $this->entityManager->persist($edited);
        //execute the queries
        $this->entityManager->flush();

        //serialize the creative into JSON
        $json = $this->serializer->serialize($edited, 'json');

        return $json;
    }

}
