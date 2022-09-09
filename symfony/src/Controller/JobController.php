<?php
namespace App\Controller;

use App\Entity\Jobs;
use App\Repository\JobsRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class JobController extends ApiController
{
    /**
    * @Route("/jobs",methods="GET")
    */
    public function index(JobsRepository $jobsRepository)
    {
        $data = $jobsRepository->transformAll();
        return $this->respond($data);
    }

    /**
    * @Route("/job/{company}/{date}/{date2}",methods="GET")
    */
    public function findCompany($company, $date, $date2, EntityManagerInterface $em, JobsRepository $companiesRepository)
    {
        $data = $companiesRepository->transformAll();
        $result = [];
        $debut = DateTime::createFromFormat('Y-m-d',$date);
        $debut = date_format($debut,'Y-m-d');
        $debut = strtotime($debut);
        $fin = DateTime::createFromFormat('Y-m-d',$date2);
        $fin = date_format($fin,'Y-m-d');
        $fin = strtotime($fin);
        if($debut > $fin){
            $a = $debut;
            $debut = $fin;
            $fin = $a;
        }
        foreach($data as $item){
            $s1 = strtotime($item['date_published']);
            $item['comp'] = $company;
            if($company == -1 ){
                if($debut<= $s1 & $fin >= $s1){
                    array_push($result, $item);
                }
            }else if(($item['company_id'] == $company) & ($debut<= $s1 & $fin >= $s1)){
                array_push($result, $item);
            }
        }
        return $this->respond($result);
    }
}