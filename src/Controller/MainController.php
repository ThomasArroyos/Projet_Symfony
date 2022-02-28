<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/planning', name: 'main')]
    public function index(CalendarRepository $calendar): Response
    {
        session_start();

        $username = $_SESSION['_sf2_attributes']['_security.last_username'];
        $rolesUser = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getRoles();
        $emailUser = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getEmail();

        //$events = $calendar->findAll();

        if ($rolesUser[0]=='ROLE_SECRETAIRE') {
            $events = $calendar->findAll();
        } else {
            $events = $calendar->findBy(['email' => $emailUser]);
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
}
