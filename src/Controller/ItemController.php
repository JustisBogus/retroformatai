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
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

/**
 * @Route("/")
 */
class ItemController extends AbstractFOSRestController
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

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        FormFactoryInterface $formFactory, FlashBagInterface $flashBag, 
        RouterInterface $router, EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage, SerializerInterface $serializer)
    {
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(BundleRepository $bundleRepository)
    {
        //$format = 'sega_genesis';
        //$items = $itemRepository->findFilteredItems($format);
        $bundles = $bundleRepository->findListedBundles();
        //$bundles = $this->entityManager->getRepository(Bundle::class)->findAll();
        
        $form = $this->formFactory->create(FilterType::class);
        return $this->render('layout/index.html.twig', 
            [
                'form' => $form->createView(),
                'bundles' => $bundles,
            ]);
    }

     /**
     * @Route("/api/items/{bundle}", name="api_items", methods={"GET"})
     */
    public function items($bundle, ItemRepository $itemRepository)
    {
        $serializer = $this->serializer;
        $tokenStorage = $this->tokenStorage;
        $user = $tokenStorage->getToken()->getUser();
        $items = $itemRepository->findAllItemsByUserAndBundle($user, $bundle);

        $json = $serializer->serialize(
            $items,
            'json', [
                'groups' => ['user', 'bundle', 'item'],
                'bundle' => $bundle
            ]
        );

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/bundles", name="api_bundles", methods={"GET"})
     */
    public function bundles(BundleRepository $bundleRepository)
    {
        $serializer = $this->serializer;
        $tokenStorage = $this->tokenStorage;
        $user = $tokenStorage->getToken()->getUser();
        $bundles = $bundleRepository->findAllBundlesByUser($user);
        //$bundle = $bundleRepository->findNewBundle($user);

        $json = $serializer->serialize(
            $bundles,
            'json', ['groups' => ['user', 'bundle', 'item']]
        );

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/additem", name="item_add", methods={"POST"})
     * @Rest\FileParam(name="image", description="Cover image", nullable=true, image=true)
     * @param ParamFetcher $paramFetcher
     */
    public function addItem(Request $request, ParamFetcher $paramFetcher)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $serializer = $this->serializer;
        $item = $serializer->deserialize($request->getContent(), Item::class, 'json');
        $requestBundle = json_decode($request->getContent(), true);
        $bundleId = isset($requestBundle['selectedBundle']) ? $requestBundle['selectedBundle'] : null;
        $bundle = $this->entityManager->getRepository(Bundle::class)->find($bundleId);
        $item->setUser($user);
        $item->setBundle($bundle);

        $file = ($paramFetcher->get('image'));

        if ($file) {
            $filename=md5(uniqid()) . '.' . $file->guessClientExtension();
            $file->move(
                $this->getParameter('uploads_dir'),
                $filename
            );

            $item->setCover('/uploads/'. $filename);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($item);
        $em->persist($bundle);
        $em->flush();
        $json = $serializer->serialize(
            $item,
            'json', ['groups' => ['user', 'bundle', 'item']]
        );
        return new Response($json);
    }

    /**
     * @Route("api/images", name="images_upload", methods={"POST"})
     * @Rest\FileParam(name="image", description="Cover image", nullable=true, image=true)
     */
    public function images(Request $request, ParamFetcher $paramFetcher)
    {
        $file = ($paramFetcher->get('image'));

        if($file) {
            $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
            $file->move(
                $this->getParameter('uploads_dir'),
                $filename
            );
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/deleteitem/{id}", name="item_delete", methods={"DELETE"})
     * @Security("is_granted('delete', item)", message="Access denied")
     */
    public function deleteItem(Item $item)
    {
        $this->entityManager->remove($item);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("api/addbundle", name="bundle_add", methods={"POST"})
     */
    public function addBundle(Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $serializer = $this->serializer;
        $bundle = $serializer->deserialize($request->getContent(), Bundle::class, 'json');
        $bundle->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($bundle);
        $em->flush();
        $json = $serializer->serialize(
            $bundle,
            'json', ['groups' => ['user', 'bundle', 'item']]
        );
        return new Response($json);
    }

    /**
     * @Route("/api/listbundle/{id}", name="bundle_list", requirements={"id"="\d+"}, methods={"PUT"})
     * @ParamConverter("bundle", class="App:Bundle")
     */
    public function bundleList(Request $request, $id)
    {
        $serializer=$this->serializer;
        $bundle = $this->getDoctrine()->getRepository(Bundle::class)->find($id);
        $data = json_decode($request->getContent(), true);
        $bundle->setListed($data['listed']);
        $bundle->setDateModified(new DateTime($data['dateModified']));

        $em = $this->getDoctrine()->getManager();
        $em->persist($bundle);
        $em->flush();

        $json = $serializer->serialize(
            $bundle,
            'json', ['groups' => ['user', 'bundle', 'item']]
        );

        return new Response($json);
    }

    /**
     * @Route("/api/deletebundle/{id}", name="bundle_delete", methods={"DELETE"})
     * @Security("is_granted('delete', bundle)", message="Access denied")
     */
    public function deleteBundle(Bundle $bundle)
    {
        $this->entityManager->remove($bundle);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/add", name="bundle_creator")
     */
    public function add(BundleRepository $bundleRepository, Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $bundles = $bundleRepository->findAllBundlesByUser($user);
            if (!$bundles) {
                $initialBundle = new Bundle();
                $initialBundle->setName("Naujas Komplektas");
                $initialBundle->setFormat("Formatas");
                $initialBundle->setListed(false);
                $initialBundle->setDateCreated(new DateTime());
                $initialBundle->setDateModified(new DateTime());
                $initialBundle->setUser($user);
                $this->entityManager->persist($initialBundle);
                $this->entityManager->flush();
            }
        }
       
        $item = new Item();
        $item->setDateCreated(new DateTime());
        $item->setDateModified(new DateTime());
        //$item->setUser($user);
        //$item->setBundle($bundle);
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
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('layout/add.html.twig', ['form' => $form->createView()]);
        }
            return new RedirectResponse($this->router->generate('security_login'));
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function profile()
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $username = $user->getUsername();

        return $this->render('layout/settings.html.twig', ['username' => $username]);
    }

    /*
     * @Route("/api/addbundle", name="bundle_add")

    public function addBundle(BundleRepository $bundleRepository, Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $bundle = $bundleRepository->findNewBundle($user);
        if ($user && $bundle) {
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
    */

    /**
     * @Route("/bundle/{id}", name="bundle")
     */
    public function show(ItemRepository $itemRepository, $id)
    {
        $items = $itemRepository->findAllBundleItems($id);

        return $this->render('items/bundle-content.html.twig', ['items' => $items ]);
    }
}