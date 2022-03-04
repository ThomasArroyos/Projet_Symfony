<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Intervenant;
use App\Repository\CalendarRepository;
use App\Repository\CouleurRepository;
use App\Repository\EleveRepository;
use App\Repository\EvenementRepository;
use App\Repository\FormationRepository;
use App\Repository\IntervenantRepository;
use App\Repository\MatiereRepository;
use App\Repository\SpecialiteRepository;
use App\Repository\UserRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/planning', name: 'main')]
    public function index(EvenementRepository $evenement,CouleurRepository $couleurRepository, IntervenantRepository $intervenantRepository, SpecialiteRepository $specialiteRepository, FormationRepository $formationRepository, EleveRepository $eleveRepository): Response
    {
        $roles = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getRoles();
        $email = unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getEmail();

        if ($roles[0] == 'ROLE_SECRETAIRE') {
            $occurences = $evenement->findAll();
            $route = 'secretaire/planning.html.twig';
        } else if ($roles[0] == 'ROLE_INTERVENANT') {
            $occurences = $formationRepository->findOneBy(['id' => $specialiteRepository->findOneBy(['id' => $intervenantRepository->findBy(['id' => unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getIntervenant()->getId()])[0]->getMatiere()->getValues()[0]->getSpecialite()->getId()])->getFormation()->getId()])->getEvenements()->getValues();
            $route = 'intervenant/planning.html.twig';
        } else {
            $occurences = $eleveRepository->findOneBy(['id' => unserialize($_SESSION['_sf2_attributes']['_security_main'])->getUser()->getEleve()->getId()])->getFormation()->getEvenements()->getValues();
            $route = 'eleve/planning.html.twig';
        }

        $rdvs = [];

        foreach($occurences as $occurence){
            $couleurs = $couleurRepository->findBy(['id' => $occurence->getMatiere()->getCouleur()->getId()]);
            $options = [];
            if($occurence->getReccurent() == 1) {
                $options = [
                    'startRecur' => $occurence->getDateDebut()->format('Y-m-d H:i:s'),
                    'endRecur' => $occurence->getDateFin()->format('Y-m-d H:i:s'),
                    'startTime' => $occurence->getDateDebutRecurrence()->format('H:i:s'),
                    'endTime' => $occurence->getDateFinRecurrence()->format('H:i:s'),
                    'daysOfWeek' => $occurence->getJoursRecurrence()
                ];
            } else if ($occurence->getJourneeEntiere() == 0){
                $options = [
                    'end' => $occurence->getDateFin()->format('Y-m-d H:i:s')
                ];
            }

            if ($occurence->getIntervenant() !== null) {
                $options = array_merge($options,[
                    'intervenant' => $occurence->getIntervenant()->getId()
                    ]);
            } else {
                $options = array_merge($options,[
                    'intervenant' => $occurence->getIntervenant()
                ]);
            }

            $options = array_merge($options,[
                'id' => $occurence->getId(),
                'title' => $occurence->getTitre(),
                'start' => $occurence->getDateDebut()->format('Y-m-d H:i:s'),
                'backgroundColor' => $couleurs[0]->getFond(),
                'borderColor' => $couleurs[0]->getBordure(),
                'textColor' => $couleurs[0]->getTexte(),
                'allDay' => $occurence->getJourneeEntiere(),
                'editable' => $occurence->getModifiable(),
                'overlap' => $occurence->getChevauchable(),
                'display' => $occurence->getEnFond(),
                'en_fond' => $occurence->getEnFond(),
                'accepte' => $occurence->getAccepte(),
                'matiere' => $occurence->getMatiere(),
                'specialite' => $occurence->getSpecialite()
            ]);
            $rdvs[] = $options;
        }
        $data = json_encode($rdvs);
        $test = "data";

        return $this->render($route, compact($test));
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
