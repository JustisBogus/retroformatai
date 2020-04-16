<?php

namespace App\Controller;

use App\Entity\Bundle;
use App\Entity\Item;
use App\Form\FilterType;
use App\Form\ItemType;
use App\Repository\BundleRepository;
use App\Repository\ItemRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(
        FormFactoryInterface $formFactory, FlashBagInterface $flashBag, 
        RouterInterface $router, EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage)
    {
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(ItemRepository $itemRepository)
    {
        //$format = 'sega_genesis';
        //$items = $itemRepository->findFilteredItems($format);
        $bundles = $this->entityManager->getRepository(Bundle::class)->findAll();
        
        $form = $this->formFactory->create(FilterType::class);
        return $this->render('layout/index.html.twig', 
            [
                'form' => $form->createView(),
                'bundles' => $bundles 
            ]);
    }

    /**
     * @Route("/add", name="item_add")
     */
    public function add(BundleRepository $bundleRepository, Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $bundle = $bundleRepository->findNewBundle($user);

        $item = new Item();
        $item->setDateCreated(new DateTime());
        $item->setDateModified(new DateTime());
        $item->setUser($user);
        $item->setBundle($bundle);
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
        }

        return $this->render('layout/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/addbundle", name="bundle_add")
     */
    public function addBundle()
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if ($user) {
            $bundle = new Bundle();
            $bundle->setDateCreated(new DateTime());
            $bundle->setDateModified(new DateTime());
            $bundle->setUser($user);
            $this->entityManager->persist($bundle);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('item_add'));
        }
            $this->flashBag->add('notice', 'Access denied');
    }

    /**
     * @Route("/bundle/{id}", name="bundle")
     */
    public function show(ItemRepository $itemRepository, $id)
    {
        $items = $itemRepository->findAllBundleItems($id);

        return $this->render('items/bundle-content.html.twig', ['items' => $items ]);
    }
}