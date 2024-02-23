<?php

namespace App\Controller;
use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/dashboard/members')]
class MemberController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    // List of all the members
    #[Route('/list', name: 'members_list', methods: 'GET')]
    public function membersList(MemberRepository $memberRepository): Response
    {
        $allMembers = $memberRepository->findAll();
        return $this->render('member/list.html.twig', [
            "members" => $allMembers
        ]);
    }
    #[Route('/{memberId}/list', name: 'members_selected_show', methods: 'GET')]
    public function showMembersSelected($memberId, MemberRepository $memberRepository): Response
    {
        $showMember = $memberRepository->findAll($memberId);
        return $this->render('member/show.html.twig', [
            "showMember" => $showMember
        ]);
    }
    #[Route('/{memberId}/edit', name: 'member_show_edit_form', methods: 'GET')]
    public function memberShowEditForm($memberId, MemberRepository $memberRepository): Response
    {
        $memberToEdit = $memberRepository->find($memberId);
        return $this->render('member/edit.html.twig', [
            'memberToEdit' => $memberToEdit,
        ]);
    }
    #[Route('/{memberId}/edit', name: 'member_save_edit_form', methods: 'POST')]
    public function memberSaveEditForm(Request $request, $memberId, MemberRepository $memberRepository): Response
    {
        $data = $request->request->all();
        $name = $data["name"];
        $email = $data["email"];
        $address = $data["address"];
        $city = $data["city"];
        $postCode = $data["postCode"];
        $country = $data["country"];
        $coverImg = $data["coverImg"];
        if(($name === "") || ($email === "") || ($address === ""))
        {
            $this->addFlash('editMemberWarning', 'Please fill all the fields!');
            return $this->redirectToRoute('member_show_edit_form', [
                "memberId" => $memberId
            ]);
        }
        $memberToEdit = $memberRepository->find($memberId);
        $memberToEdit->setName($name);
        $memberToEdit->setEmail($email);
        $memberToEdit->setAddress($address);
        $memberToEdit->setCity($city);
        $memberToEdit->setPostCode($postCode);
        $memberToEdit->setCountry($country);
        $this->entityManager->persist($memberToEdit);
        $this->entityManager->flush();
        $this->addFlash('editSuccess', 'Member Edited Successfully!');
        return $this->redirectToRoute('members_list');

    }
    #[Route('/{memberId}/delete', name: 'member_to_delete', methods: ['GET','POST'])]
    public function removeMember(Request $request, $memberId, MemberRepository $memberRepository): Response
    {
      /*  //$data = $request->request->all();
        $memberToDelete = $memberRepository->find($memberId);
        //dd($memberToDelete);
        $this->entityManager->remove($memberToDelete);
        $this->entityManager->flush();
        $this->addFlash('deleteSuccess', 'Member deleted Successfully!');
        return $this->redirectToRoute('members_list');*/

    }

}
