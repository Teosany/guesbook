<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
//    public function index(Environment $twig, ConferenceRepository $conferenceRepository): Response
    public function index(ConferenceRepository $conferenceRepository): Response
    {
//        return new Response($twig->render('conference/index.html.twig', [
        return $this->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Request $request, Conference $conference, CommentRepository $commentRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $comments = $commentRepository->getCommentPaginator($conference, $offset);

//        $comments = Pagerfanta::createForCurrentPageWithMaxPerPage(
//            new ArrayAdapter($commentRepository->findAll()),
//            $request->query->get('page', 1),
//            2
//        );

        dump($request->query, $offset - CommentRepository::COMMENTS_PER_PAGE, min(count($comments), $offset + CommentRepository::COMMENTS_PER_PAGE));

        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $comments,
            'previous' => $offset - CommentRepository::COMMENTS_PER_PAGE,
            'next' => min(count($comments), $offset + CommentRepository::COMMENTS_PER_PAGE)
        ]);
    }
}
