<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CalendarRepository $calendar): Response
    {
        session_start();

        $username = $_SESSION['_sf2_attributes']['_security.last_username'];
        $rolesUser = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getRoles();
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event){
            if (array_search('ROLE_SECRETAIRE', $rolesUser) != false) {
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
            } else {
                if ($event->getEmail() == $username) {
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
            }
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
}
