<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;

class LocationsController extends AbstractController
{
    /**
     * @Route("/api/locations", name="locations")
     */
    public function index(): Response
    {
        $locations = $this->getDoctrine()
            ->getRepository(Location::class)
            ->childrenHierarchy();

        return $this->json($locations);
    }
}
