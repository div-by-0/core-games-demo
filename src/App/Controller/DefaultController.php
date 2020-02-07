<?php

namespace App\Controller;

use App\Application\Sonata\MediaBundle\Entity\Gallery;
use App\Form\Type\SearchType;
use Application\TenderBundle\Entity\Tender;
use Application\TenderBundle\Service\TenderManager;
use Core\ContentsBundle\Entity\Content;
use Core\ContentsBundle\Search\SearchManager;
use Core\ContentsBundle\Service\ContentManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Sonata\MediaBundle\Entity\GalleryManager;
use Sonata\MediaBundle\Model\GalleryManagerInterface;
use Sonata\SeoBundle\Seo\SeoPage;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
}
