<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MediumController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('layout/index.html.twig');
    }

    /**
     * @Route("/add", name="item_add")
     */
    public function add()
    {

    }

    /**
     * @Route("/show/{id}", name="item_show")
     */
    public function show($id)
    {
        
    }
}