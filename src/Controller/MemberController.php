<?php

namespace App\Controller;
use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/dashboard')]
class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function showMember(MemberRepository $memberRepository): Response
    {
        $allMembers = $memberRepository->findAll();
        return $this->render('member/list-member.html.twig', [
            "members" => $allMembers
        ]);
    }

    #[Route('/member/edit', name: 'app_member_edit')]
    public function editMember(): Response
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
}
