<?php

namespace TP\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use TP\TestBundle\Form\ProductType;
use TP\TestBundle\Entity\Product;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('TPTestBundle:Index:index.html.twig');
    }

    public function addAction(Request $request)
    {
        $product = new Product();

        $form = $this
                ->container
                ->get('form.factory')
                ->create(ProductType::class, $product);

        // Si la requête est en POST
        if ($request->isMethod('POST'))
        {
            // On fait le lien Requête <-> Formulaire
            // A partir de maintenant, la variable $article contient les valeurs entrées dans le Formulaire
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid())
            {
                $em = $this->container->get('doctrine.orm.entity_manager');     // Connexion à la BDD via l'Entity Manager
                $em->persist($product);                                         // Remplit $article
                $em->flush();                                                   // Commit à la BDD

                return $this->redirectToRoute('tp_test_add_product');           // Efface le formulaire une fois validé
            }
        }

        return $this->render('TPTestBundle:Index:add_product.html.twig',
                       array('myForm' => $form->createView())); // l'ARRAY sert à appeler le formulaire
    }

    public function lastProductAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');             // Entity Manager : Sert à aller chercher le Repo de Entity Manager
        $productRepository = $em->getRepository('TPTestBundle:Product');        //->find($idArticle);
                                                                                // Va chercher le Repo de notre Class Article
        $productList = $productRepository->lastProductList();                       // Passer en Paramètre le Repo de Product

        return $this->render('TPTestBundle:Index:last_product.html.twig', array('productList' => $productList));

    }

}
