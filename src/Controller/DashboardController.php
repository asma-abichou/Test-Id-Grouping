<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }
    #[Route('/dashboard/home', name: 'app_dashboard_home')]
    public function home(): Response
    {
        return $this->render('dashboard/home.html.twig');
    }
    #[Route('/dashboard/settings', name: 'app_dashboard_settings')]
    public function settingsUser(): Response
    {
        return $this->render('dashboard/account-profile.html.twig');
    }
}
