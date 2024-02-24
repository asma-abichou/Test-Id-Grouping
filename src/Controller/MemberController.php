<?php

namespace App\Controller;
use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FileUploadError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    //Show a Member
    #[Route('/{memberId}/list', name: 'members_selected_show', methods: 'GET')]
    public function showMembersSelected($memberId, MemberRepository $memberRepository): Response
    {
        $showMember = $memberRepository->find($memberId);
        return $this->render('member/show.html.twig', [
            "showMember" => $showMember
        ]);
    }

    //Show Member to edit
    #[Route('/{memberId}/edit', name: 'member_show_edit_form', methods: 'GET')]
    public function memberShowEditForm($memberId, MemberRepository $memberRepository): Response
    {
        $memberToEdit = $memberRepository->find($memberId);
        return $this->render('member/edit.html.twig', [
            'memberToEdit' => $memberToEdit,
        ]);
    }

    //Process edit a member
    #[Route('/{memberId}/edit', name: 'member_save_edit_form', methods: 'POST')]
    public function memberSaveEditForm(Request $request, $memberId, MemberRepository $memberRepository): response
    {
        $member = $memberRepository->find($memberId);
        //dd($member);
        $isActive = $member->getActif();
            if ($isActive === 0) {
                $member->setActif(1);
            } else {
                $member->setActif(0);
            }
            $this->entityManager->persist($member);
            $this->entityManager->flush();
            $this->addFlash('editMemberSuccess', 'Membre modifié avec succès!');

            return $this->redirectToRoute('members_list', [
                'member' => $member,
            ]);

    }
   /*
        $this->entityManager->persist($member);
        $this->entityManager->flush();
        $this->addFlash('editMemberSuccess', 'Membre modifié avec succès!');

        return $this->redirectToRoute('members_list', [
            'member' =>$member,
        ]);
       $name = $data["name"];
        $email = $data["email"];
        $address = $data["address"];
        $city = $data["city"];
        $postCode = $data["postCode"];
        $country = $data["country"];
        $pictureFile = $request->files->get('coverImg');

        if(($name === "") || ($email === "") || ($address === "") )
        {
            $this->addFlash('editMemberWarning', 'Veuillez remplir tous les champs!');
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
        if ($pictureFile){
            //generate a name  for picture
            $pictureFileName = md5(uniqid ()). $pictureFile->getClientOriginalName();
            //remove space from the name picture
            $pictureFileName = str_replace(" ", "", $pictureFileName);
            $picturePath =  "/public/uploaded-pictures/";
            // get full path where to upload the picture
            $fullPath = $this->getParameter('kernel.project_dir') . $picturePath;
            // uploading the picture to the folder
            $pictureFile->move($fullPath, $pictureFileName);
            // Saving picture path in the database
            $memberToEdit->setCoverImg($pictureFileName);
        }*/

    //Delete a Member
    #[Route('/{memberId}/delete', name: 'member_to_delete')]
    public function removeMember($memberId, MemberRepository $memberRepository): Response
    {
        //$data = $request->request->all();
        $memberToDelete = $memberRepository->find($memberId);
        //dd($memberToDelete);
        $this->entityManager->remove($memberToDelete);
        $this->entityManager->flush();
        $this->addFlash('deleteSuccess', 'Membre supprimé avec succès!');
        return $this->redirectToRoute('members_list');
    }
}


