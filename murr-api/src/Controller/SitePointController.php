<?php

namespace App\Controller;

use App\Repository\PointRepository;
use App\Repository\SiteRepository;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Point;
use App\Entity\Site;
use App\Entity\Pickup;

class SitePointController
{
    public function __invoke(Pickup $data): Response
    {
        // TODO: Implement adding points to site in here
    }
}
