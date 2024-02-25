<?php

namespace App\Controller;

use App\Form\MyProfileFormType;
use App\Repository\MemberRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }
    //show home page and display the sum of member
    #[Route('/home', name: 'home')]
    public function home(MemberRepository $memberRepository): Response
    {
        $allMembers = $memberRepository->findAll();
        return $this->render('dashboard/home.html.twig', [
            'allMembers' => $allMembers
        ]);
    }
    // process profile user change password ,email and profile image
    #[Route('/settings', name: 'settings')]
    public function ProfileUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger, UserRepository $userRepository): Response
    {
        //get the user identifier (email)
        $currentUserEmail = $this->getUser()->getUserIdentifier();
        $currentUser = $userRepository->findOneBy(["email" => $currentUserEmail]);
        //get the password of current user
        $currentUserPassword = $currentUser->getPassword();
        //create form profile user
        $form = $this->createForm(MyProfileFormType::class, $currentUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $profileImageFile */
            $profileImageFile = $form->get('profileImage')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($profileImageFile) {
                $originalFilename = pathinfo($profileImageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $profileImageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $profileImageFile->move(
                        $this->getParameter('profile_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    // add error flash message and redirect to settings page
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $currentUser->setProfileImage($newFilename);
            }
            $password = $form->get('password')->getData();
            if($password)
            {
                // encode the plain password
                $currentUser->setPassword($userPasswordHasher->hashPassword($currentUser, $password));
            } else {
                $currentUser->setPassword($currentUserPassword);
            }
            $this->entityManager->persist($currentUser);
            $this->entityManager->flush();
            $this->addFlash('editProfileSuccess', 'Vos informations ont été modifiés avec succès!');
            return $this->redirectToRoute('settings');
        }
        return $this->render('dashboard/my_profile.html.twig', [
            'myProfileForm' => $form->createView(),
        ]);
    }
}
