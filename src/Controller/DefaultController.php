<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="homepage")
     */
    public function homepage()
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $repo */
        $repo = $manager->getRepository(Product::class);

        return $this->render('homepage.html.twig', [
            'thibaud' => 'He\'s awesome anyway 😎',
        ]);
    }

    /**
     * @Route(path="/product", name="Products")
     */
    public function index(RegistryInterface $doctrine)
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        return $this->render('index.html.twig', compact('products'));
    }

    /**
     * @Route(path="/product/show/{id}", name="Product")
     */
    public function show(RegistryInterface $doctrine, $id)
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
        return $this->render('show.html.twig', compact('product'));
    }
}