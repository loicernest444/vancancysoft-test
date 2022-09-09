<?php
namespace App\Controller;

use App\Entity\Professions;
use App\Repository\ProfessionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProfessionController extends ApiController
{
    /**
    * @Route("/professions",methods="GET")
    */
    public function index(ProfessionsRepository $professionRepository)
    {
        $data = $professionRepository->transformAll();
        return $this->respond($data);
    }

    
}