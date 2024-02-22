<?php

namespace App\Controller;
use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/member/edit', name: 'app_member_edit_form')]
    public function editMemberList(): Response
    {
        return $this->render('member/edit-member.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
    #[Route('/member/{memberId}/edit', name: 'app_member_edit', methods: 'POST')]
    public function editMemberProcess(Request $request, MemberRepository $memberRepository): Response
    {
        return $this->render('member/edit-member.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

}
