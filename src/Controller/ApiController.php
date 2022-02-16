<?php

namespace App\Controller;

use App\Entity\Calendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route ("/api/add", name="api_event_add", methods={"PUT"})
     */
    public function addEvent(?Calendar $calendar, Request $request)
    {
        //Recupération des données
        $donnees = json_decode($request->getContent());
        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            //Données complètes
            //Initialisation du code 200
            $code = 200;

            //Vérification ID
            if(!$calendar){
                //Instantiation rdv
                $calendar =new Calendar();

                //Changement de code
                $code = 201;
            }

            //Hydratation de l'objet
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new \DateTime($donnees->start));
            if ($donnees->allDay){
                $calendar->setEnd(new \DateTime($donnees->start));
            }else{
                $calendar->setEnd(new \DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            //Retourner code
            return new Response('Ok', $code);

        } else {
            //Données incomplètes
            return new Response('Données incomplètes', 404);
        }
    }

    /**
     * @Route ("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar, Request $request)
    {
        //Recupération des données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            //Données complètes
            //Initialisation du code 200
            $code = 200;

            //Vérification ID
            if(!$calendar){
                //Instantiation rdv
                $calendar =new Calendar();

                //Changement de code
                $code = 201;
            }

            //Hydratation de l'objet
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new \DateTime($donnees->start));
            if ($donnees->allDay){
                $calendar->setEnd(new \DateTime($donnees->start));
            }else{
                $calendar->setEnd(new \DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            //Retourner code
            return new Response('Ok', $code);

        } else {
            //Données incomplètes
            return new Response('Données incomplètes', 404);
        }
    }

    /**
     * @Route ("/api/{id}/delete", name="api_event_delete", methods={"PUT"})
     */
    public function deleteEvent(?Calendar $calendar, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entry = $em->getRepository('App:Calendar')->find($calendar);
        $em->remove($entry);
        $em->flush();

        $code = 204;

        return new Response('Ok', $code);
    }
}
