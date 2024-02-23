<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function home(MemberRepository $memberRepository): Response
    {
        $allMembers = $memberRepository->findAll();
        return $this->render('dashboard/home.html.twig', [
            'allMembers' => $allMembers
        ]);
    }
    #[Route('/settings', name: 'settings')]
    public function settings(): Response
    {
        return $this->render('dashboard/account_profile.html.twig');
    }
}
