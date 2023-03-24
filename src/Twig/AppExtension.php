<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class AppExtension extends AbstractExtension
{
    /**@var User $currentUser */
    private $currentUser;

    public function __construct(
        Security $security
    ) {
        //$this->entityManagerInterface = $entityManagerInterface;
        $this->currentUser = $security->getUser();
    }

    public function getFilters()
    {
        return [
            new TwigFilter('extractText', [$this, 'extractTextFromBD']),
        ];
    }

    public function extractTextFromBD($content, $length = 10)
    {

        $content = $content;
        if (strlen($content) > $length) {
            $content = substr($content, 0, $length);
            $content = substr($content, 0, strrpos($content, ' ')) . ' ...';
        }


        return str_replace('<p>', '', $content);
    }
}
