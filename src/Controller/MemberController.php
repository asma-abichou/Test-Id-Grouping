<?php

namespace App\Controller;
use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/dashboard')]
class MemberController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/member', name: 'app_member')]
    public function showMember(MemberRepository $memberRepository): Response
    {
        $allMembers = $memberRepository->findAll();
        return $this->render('member/list-member.html.twig', [
            "members" => $allMembers
        ]);
    }
    #[Route('/member/{memberId}/edit', name: 'app_member_form')]
    public function showEditMember($memberId, MemberRepository $memberRepository): Response
    {
        $memberToEdit = $memberRepository->find($memberId);
        return $this->render('member/edit-member.html.twig', [
            'memberToEdit' => $memberToEdit,
        ]);
    }
    #[Route('/member/{memberId}/edit', name: 'app_member_edit', methods: 'POST')]
    public function editMemberProcess(Request $request, $memberId, MemberRepository $memberRepository): Response
    {
        //dd('test');
        $data = $request->request->all();
        $name = $data["name"];
        $email = $data["email"];
        $city = $data["city"];

        if(($name === "") || ($email === "")|| ($city === ""))
        {
            $this->addFlash('editMemberWarning', 'Please fill all the fields!');
            return $this->redirectToRoute('app_member_form', [
                "memberId" => $memberId
            ]);
        }
        $memberToEdit = $memberRepository->find($memberId);
        $memberToEdit->setName($name);
        $memberToEdit->setEmail($email);
        $memberToEdit->setCity($city);
        //dump($memberToEdit);
        $this->entityManager->persist($memberToEdit);
        $this->entityManager->flush();
        $this->addFlash('editSuccess', 'Student Edited Successfully!');

        return $this->redirectToRoute('app_member');

    }
}
