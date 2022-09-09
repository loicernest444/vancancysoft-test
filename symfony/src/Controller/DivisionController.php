<?php
namespace App\Controller;

use App\Entity\Divisions;
use App\Repository\DivisionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DivisionController extends ApiController
{
    /**
    * @Route("/divisions",methods="GET")
    */
    public function index(DivisionsRepository $divisionsRepository)
    {
        $data = $divisionsRepository->transformAll();
        return $this->respond($data);
    }

}