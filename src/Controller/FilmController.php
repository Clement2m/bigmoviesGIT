<?php

namespace App\Controller;

use App\Entity\Critique;
use App\Entity\Films;
use App\Form\CritiqueType;
use App\Repository\FilmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/film")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="film_index")
     */
    public function index(Request $request)
    {
        // --------------- FILM
        $nomFilm = $request->get("nom_film");

        //On va chercher les films dans la BDD
        /* @var FilmsRepository $em */
        $em = $this->getDoctrine()->getRepository(Films::class);
        //On appelle la requete qui ressort le film
        $film = $em->findOneByName($nomFilm);

        // --------------- CRITIQUES
        //Appelle la BDD et récupère le repository de l'entité Critique
        $em = $this->getDoctrine()->getRepository(Critique::class);
        //Stock toutes les critiques
        $critiques = $em->findAll();
        //On veut ressortir toutes les critiques correspondant au film

        return $this->render('film/film.html.twig', [
            "critiques" => $critiques,
            "film" => $film
        ]);
    }

    /**
     * @Route("/ajoutCritique", name="film_ajout_critique")
     */
    public function ajoutCritique(Request $request)
    {
        //On crée une nouvelle entité Critique
        $critique = new Critique();

        //On créé un formulaire
        $form = $this->createForm(CritiqueType::class, $critique);
        //On ajoute un bouton submit
        $form->add("ajouter", SubmitType::class);

        //On récupère la requete (Get) pour la manipuler
        $form->handleRequest($request);

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            //------------SUR QUEL FILM AJOUTER LA CRITIQUE
            $nomFilm = $request->get("nom_film");
            //On va chercher les films dans la BDD
            /* @var FilmsRepository $em */
            $em = $this->getDoctrine()->getRepository(Films::class);
            //On appelle la requete qui ressort le film
            $film = $em->findOneByName($nomFilm);

            $critique->setTexteCritique($form->get("texte_critique")->getData());
            $critique->setNameUser($form->get("name_user")->getData());

            $film->addCritique($critique);
            //-------------------------------------------

            //Insertion dans la base
            $em = $this->getDoctrine()->getManager();
            $em->persist($critique);
            $em->flush();

            //Ajout d'un message de succès --> a ajouter dans la base twig
            //$this->addFlash("success", "Votre livre a bien été ajouté");

            return $this->redirectToRoute("film_index", [
                "nom_film" => $nomFilm
            ]);
        }

        return $this->render('film/ajoutCritique.html.twig', [
            'formAjoutCritique' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifierCritique/{id}", name="film_modifier_critique")
     * @param Critique $critique
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function modifierCritique(Critique $critique)
    {

        //Je récupère le formulaire et l'alimente avec les données de la critique
        $form = $this->createForm(CritiqueType::class, $critique);
        //On ajoute un bouton submit
        $form->add("modifier", SubmitType::class);

        return $this->render('film/modifCritique.html.twig', [
            'critique' => $critique,
            'formModifCritique' => $form->createView()
        ]);
    }

    /**
     * @Route("/supprimerCritique", name="film_supprimer_critique")
     */
    public function supprimerCritique(Request $request)
    {

        return $this->render('film/supprimerCritique.html.twig', [

        ]);
    }
}
