<?php


namespace App\Http\Action;


use App\Model\Link\LinkRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectToLink extends AbstractController
{
    private LinkRepositoryInterface $linkRepository;

    function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function __invoke($_hash)
    {
        $link = $this->linkRepository->findByHash($_hash);

        if (!$link) {
            throw new NotFoundHttpException();
        }

        $link->getVisits()->increment();
        $this->linkRepository->save($link);

        return $this->redirect($link->getUrl()->toString());
    }
}