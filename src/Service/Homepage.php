<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class Homepage
{

    // Recuperer le total des sites enregsistrer, les users enregistrer, les abonnés
    // recuperer les nombres de sites par province 

    private EntityManagerInterface $manager;
    private $date;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getStats()
    {
        $this->date = date('Y-m-d');
        $testimonials = $this->getTestimonials();
        $news = $this->getNews();
        $services = $this->getServices();
        $partners = $this->getPartners();

        return compact("testimonials", "news", "services");
    }

    public function getPartners()
    {
        return $this->manager->createQuery("SELECT  p FROM App\Entity\Partner p  ORDER BY p.updatedAt DESC ")
            ->getResult();
    }

    public function getTestimonials()
    {
        return $this->manager->createQuery("SELECT  t FROM App\Entity\Testimonial t  ORDER BY t.updatedAt DESC ")
            ->setMaxResults(3)
            ->getResult();
    }

    public function getNews()
    {
        return $this->manager->createQuery("SELECT  n FROM App\Entity\News n  ORDER BY n.publiedAt DESC")
            ->setMaxResults(3)
            ->getResult();
    }

    public function getServices()
    {
        return $this->manager->createQuery("SELECT  s FROM App\Entity\Service s  ORDER BY s.updatedAt DESC, s.name ")
            ->setMaxResults(3)
            ->getResult();
    }
}
