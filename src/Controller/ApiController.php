<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\Matiere;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

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
            $calendar->setEmail($donnees->email);
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

    /**
     * @Route ("/api/search/{id}", name="api_event_search", methods={"GET"})
     */
    public function searchEvent(?Calendar $calendar, Request $request)
    {
        $id = $request->attributes->get('id');

        $calendarRepository = $this->getDoctrine()->getManager()
            ->getRepository(Calendar::class);
        $events = $calendarRepository->findBy(['id'=>$id]);

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

        dd(json_encode($rdvs));
    }



    /**
     * @Route ("/api/users", name="api_user_search", methods={"GET"})
     */
    public function searchUsers(Request $request)
    {
        $userRepository = $this->getDoctrine()->getManager()
            ->getRepository(User::class);
        $users = $userRepository->findAll();

        $userJSON = [];

        foreach($users as $user){
            $userJSON[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
            ];
        }

        //dd($userJSON);
        return new Response(json_encode($userJSON));
        //return $this->render($userJSON);
        //return (json_encode($userJSON));

    }

    /**
     * @Route ("/api/users/add", name="api_user_add", methods={"PUT"})
     */
    public function addUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager)
    {
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->email) && !empty($donnees->email) &&
            isset($donnees->roles) && !empty($donnees->roles) &&
            isset($donnees->password) && !empty($donnees->password) &&
            isset($donnees->matieres) && !empty($donnees->matieres)
        ){
            $user = new User();

            //Hydratation de l'objet
            //$user->setId($donnees->id);
            $user->setEmail($donnees->email);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $donnees->password
                ));
            $user->setMatieres($donnees->matieres);
            $user->setRoles(explode(",",$donnees->roles));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //Retourner code
            return new Response('Ok', 206);

        } else {
            //Données incomplètes
            return new Response('Données incomplètes', 404);
        }
    }

    /**
     * @Route ("/api/users/edit/{id}", name="api_user_edit", methods={"PUT"})
     */
    public function editUser(?User $user, Request $request)
    {
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->id) && !empty($donnees->id) &&
            isset($donnees->email) && !empty($donnees->email) &&
            isset($donnees->roles) && !empty($donnees->roles) &&
            isset($donnees->password) && !empty($donnees->password) &&
            isset($donnees->matieres) && !empty($donnees->matieres)
        ){
            //$user->setId($donnees->id);
            $user->setEmail($donnees->email);
            $user->setPassword($donnees->password);
            /*$user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $donnees->password->get('plainPassword')->getData()
                ));*/
            $user->setMatieres($donnees->matieres);
            $user->setRoles(explode(",",$donnees->roles));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //Retourner code
            return new Response('Ok', "SUBARU IMPREZA");

        } else {
            //Données incomplètes
            return new Response('Données incomplètes', 404);
        }
    }

    /**
     * @Route ("/api/users/delete/{id}", name="api_user_delete", methods={"PUT"})
     */
    public function deleteUser(?UserRepository $user, Request $request)
    {
        $donnees = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        $entrys = $em->getRepository('App:User')->findBy(['id' => $donnees->id]);
        foreach ($entrys as $entry) {
            $em->remove($entry);
            $em->flush();
        }

        $code = 204;

        return new Response('Ok', $code);
    }

    /**
     * @Route ("/api/matieres/add", name="api_matrieres_add", methods={"PUT"})
     */
    public function addMatiere(Request $request, EntityManagerInterface $entityManager)
    {
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->nomMatiere) && !empty($donnees->nomMatiere) &&
            isset($donnees->dureeTotale) && !empty($donnees->dureeTotale)
        ){
            $matiere = new Matiere();

            $matiere->setNomMatiere($donnees->nomMatiere);
            $matiere->setDureeTotale($donnees->dureeTotale);

            if ($donnees->intervenantAffecte != "Personne") {

            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            //Retourner code
            return new Response('Ok', 206);

        } else {
            //Données incomplètes
            return new Response('Données incomplètes', 404);
        }
    }
}
