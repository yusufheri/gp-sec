<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    /**
     * @Route("/subscriber-newsletters", name="app_subscriber_newsletter")
     */
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        $email = $request->request->get('email');
        $referer = $request->server->get('HTTP_REFERER');

        $rsm = new ResultSetMapping();
        if ($this->is_url_valid($referer)) {
            if ($this->verifyEmail($email)) {
                $query = $entityManagerInterface->createNativeQuery('SELECT * FROM newsletter WHERE email = ?', $rsm);
                $listEmail = $query->setParameter(1, $email)->getResult();

                if (count($listEmail) == 0) {

                    $subscriber = new Newsletter();
                    $subscriber->setCreatedAt(new \DateTimeImmutable())
                        ->setEmail($email);

                    $entityManagerInterface->persist($subscriber);
                    $entityManagerInterface->flush();

                    $this->addFlash('success', '<h4>Vous serez le premier à être informé sur toutes nos offres et actualités !😎😊</h4>');
                } else {
                    $this->addFlash('danger', '<h4>Cette adresse mail a été déjà enregistrée dans notre liste des abonnés !🙄</h4>');
                }
            } else {
                $this->addFlash('danger', '<h4>Cette adresse mail n\'est pas valide !🙄</h4>');
            }
        } else {
            $this->addFlash('danger', '<h4>Cette adresse mail n\'est pas valide !🙄</h4>');
            return $this->redirectToRoute('app_contact_us');
        }

        return $this->redirect($referer);
    }

    function verifyEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function is_url_valid($url)
    {
        $pattern = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $pattern2 = '/^(http?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        if (preg_match($pattern, $url) || preg_match($pattern2, $url)) {
            return true;
        } else {
            return false;
        }
    }
}
