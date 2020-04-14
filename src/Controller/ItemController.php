<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\FilterType;
use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/")
 */
class ItemController extends AbstractController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

     /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        FormFactoryInterface $formFactory, FlashBagInterface $flashBag, 
        RouterInterface $router, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $form = $this->formFactory->create(FilterType::class);
        return $this->render('layout/index.html.twig', ['form' => $form->createView() ]);
    }

    /**
     * @Route("/add", name="item_add")
     */
    public function add(Request $request)
    {
        $item = new Item();
        $item->setDateCreated(new \DateTime());
        $item->setDateModified(new \DateTime());
        $form = $this->formFactory->create(ItemType::class, $item);
        $form->handleRequest($request);
        $honeyPot = $item->getHoneyPot();

        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($honeyPot)) {
                $this->entityManager->persist($item);
                $this->entityManager->flush();
            } else {
                $this->flashBag->add('notice', 'Spam');
            }
            //return new RedirectResponse($this->router->generate('index'));
        }

        return $this->render('layout/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/show/{id}", name="item_show")
     */
    public function show($id)
    {
        
    }
}