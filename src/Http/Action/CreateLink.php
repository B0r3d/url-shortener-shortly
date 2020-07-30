<?php


namespace App\Http\Action;


use App\Http\Response\ErrorJsonResponse;
use App\Http\Response\SuccessJsonResponse;
use App\Model\Link\LinkFactoryInterface;
use App\Model\Link\LinkRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateLink extends AbstractController
{
    private LinkRepositoryInterface $linkRepository;
    private LinkFactoryInterface $linkFactoryInterface;

    function __construct(LinkRepositoryInterface $linkRepository, LinkFactoryInterface $linkFactoryInterface)
    {
        $this->linkRepository = $linkRepository;
        $this->linkFactoryInterface = $linkFactoryInterface;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (empty($data['url'])) {
                throw new BadRequestHttpException('Property "url" missing or empty.');
            }

            $link = $this->linkRepository->findByUrl($data['url']);

            if (!$link) {
                $link = $this->linkFactoryInterface->createLink($data['url']);
                $this->linkRepository->save($link);
            }

            return SuccessJsonResponse::fromArray([
                'link' => [
                    'hash' => $link->getHash()->toString(),
                    'url_long' => $link->getUrl()->toString(),
                    'url_short' => $this->generateUrl('go_to_link', ['_hash' => $link->getHash()->toString()]),
                ]
            ], Response::HTTP_CREATED);
        } catch(\Throwable $throwable) {
            return ErrorJsonResponse::fromThrowable($throwable);
        }
    }
}