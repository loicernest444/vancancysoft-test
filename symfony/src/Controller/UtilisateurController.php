<?php
namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UtilisateurController extends ApiController
{
    /**
    * @Route("/users", methods="GET")
    */
    public function index(UtilisateursRepository $utilisateurRepository)
    {
        $utilisateurs = $utilisateurRepository->transformAll();

        return $this->respond($utilisateurs);
    }

    /**
    * @Route("/users", methods="POST")
    */
    public function create(Request $request, UtilisateursRepository $utilisateursRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (! $request->get('nom')) {
            return $this->respondValidationError('Please provide a nom!');
        }
        if (! $request->get('role')) {
            return $this->respondValidationError('Please provide a role!');
        }
        if (! $request->get('profession')) {
            return $this->respondValidationError('Please provide a profession!');
        }
        if (! $request->get('division')) {
            return $this->respondValidationError('Please provide a division!');
        }
        if (! $request->get('login')) {
            return $this->respondValidationError('Please provide a login!');
        }
        if (! $request->get('password')) {
            return $this->respondValidationError('Please provide a password!');
        }

        // persist the new movie
        $utilisateur = new Utilisateurs;
        $utilisateur->setNom($request->get('nom'));
        $utilisateur->setRole($request->get('role'));
        $utilisateur->setProfession($request->get('profession'));
        $utilisateur->setDivision($request->get('division'));
        $utilisateur->setLogin($request->get('login'));
        $utilisateur->setPassword(password_hash($request->get('nom'),PASSWORD_BCRYPT, ["cost",12]));
        if($request->get('email') & filter_var($request->get('email'),FILTER_VALIDATE_EMAIL)){
            $utilisateur->setEmail($request->get('email'));
        }
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        $utilisateur->setToken($token);
        $em->persist($utilisateur);
        $em->flush();

        return $this->respondCreated($utilisateursRepository->transform($utilisateur));
    }

}
