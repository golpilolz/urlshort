<?php

namespace App\Controller;

use App\Entity\Redirection;
use App\Form\RedirectionType;
use App\Repository\RedirectionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppController extends AbstractController {

  #[Route('/', name: 'app.home')]
  public function home(Request $request, ManagerRegistry $doctrine, TranslatorInterface $translator): Response {
    $redirection = new Redirection();
    $form = $this->createForm(RedirectionType::class, $redirection);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();
      $entityManager->persist($redirection);
      $entityManager->flush();
      $this->addFlash('success', $translator->trans('link.generate.sucess', [
        '@link' => $this->generateUrl('app.goto', [
          'token' => $redirection->getToken()
        ], UrlGeneratorInterface::ABSOLUTE_URL)
      ]));
      return $this->redirectToRoute('app.home');
    }

    return $this->renderForm('home/home.html.twig', [
      'form' => $form
    ]);
  }

  #[Route('/l/{token}', name: 'app.goto')]
  public function goto(string $token, RedirectionRepository $redirectionRepository, TranslatorInterface $translator): RedirectResponse {
    $redirection = $redirectionRepository->findOneByToken($token);
    if (is_null($redirection)) {
      $this->addFlash('error', $translator->trans('link.fetch.not-found'));
      return $this->redirectToRoute('app.home');
    }
    return $this->redirect($redirection->getLink());
  }
}
