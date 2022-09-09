<?php
namespace App\Controller;

use App\Entity\Roles;
use App\Repository\RolesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RoleController extends ApiController
{
    /**
    * @Route("/roles",methods="GET")
    */
    public function index(RolesRepository $rolesRepository)
    {
        $data = $rolesRepository->transformAll();
        return $this->respond($data);
    }
}