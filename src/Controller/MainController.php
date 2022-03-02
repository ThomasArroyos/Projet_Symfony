<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\EvenementRepository;
use App\Repository\MatiereRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/planning', name: 'main')]
    public function index(EvenementRepository $evenement): Response
    {
        $roles = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getRoles();
        $email = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getEmail();

        if ($roles[0] == 'ROLE_SECRETAIRE') {
            dd($evenement->findAll());
            $occurence = $evenement->findAll();
        } else {
            $occurence = $evenement->findBy(['email' => $email]);
        }

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'email' => $event->getEmail(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }

    /**
     * @Route ("/users", name="users")
     */
    public function indexUser(UserRepository $user): Response
    {
        $utilisateurs = $user->findAll();

        $tabUtilisateurs = [];

        foreach($utilisateurs as $utilisateur){
            $tabUtilisateurs[] = [
                'id' => $utilisateur->getId(),
                'email' => $utilisateur->getEmail(),
                'roles' => $utilisateur->getRoles(),
                'password' => $utilisateur->getPassword(),
                'matieres' => $utilisateur->getMatieres(),
            ];
        }

        $data = json_encode($tabUtilisateurs);

        return $this->render('main/users.html.twig', compact('data'));
    }

    /**
     * @Route ("/matieres", name="matieres")
     */
    public function indexMatiere(MatiereRepository $mat,UserRepository $user): Response
    {
        $matieres = $mat->findAll();

        $tabMatieres = [];

        foreach($matieres as $matiere){
            if ($matiere->getIntervenantAffecte()->toArray() == []) {
                $tabMatieres[] = [
                    'id' => $matiere->getId(),
                    'nomMatiere' => $matiere->getNomMatiere(),
                    'dureeTotale' => $matiere->getDureeTotale(),
                    'intervenantAffecte' => "Personne"
                ];
            } else {
                $tabMatieres[] = [
                    'id' => $matiere->getId(),
                    'nomMatiere' => $matiere->getNomMatiere(),
                    'dureeTotale' => $matiere->getDureeTotale(),
                    'intervenantAffecte' => $matiere->getIntervenantAffecte()->toArray()[0]->getEmail()
                ];
            }
        }

        $dataMatiere = json_encode($tabMatieres);

        $utilisateurs = $user->findAll();

        $tabUtilisateurs = [];

        foreach($utilisateurs as $utilisateur){
            $tabUtilisateurs[] = [
                'email' => $utilisateur->getEmail()
            ];
        }

        $dataUser = json_encode($tabUtilisateurs);

        return $this->render('main/matieres.html.twig', compact(['dataMatiere','dataUser']));
    }
}
