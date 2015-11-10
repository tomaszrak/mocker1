<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Header;
use AppBundle\Entity\Mock;
use AppBundle\Form\Type\MockType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // Fix to show first clear header inputs
        $mock = new Mock();
        $header = new Header();
        $mock->addHeader($header);
        $header->setMock($mock);

        $form = $this->createForm(new MockType(), $mock);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $mockService = $this->get('mock_service');
            $mockUrl = $mockService->generateMockUrl($mock);
            $mockUrl = $request->getSchemeAndHttpHost() . '/' . $mockUrl;

            return new Response($mockUrl);
        }

        return $this->render('default/main.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{mockUrl}", name="mock")
     */
    public function mockAction(Request $request, $mockUrl)
    {
        $mockService = $this->get('mock_service');
        $mock = $mockService->getMock($mockUrl);

        if ($mock->getMethod() != $request->getMethod()) {
            throw $this->createNotFoundException('Wrong request method!');
        }

        $response = new Response();

        $convertedBody = $mockService->convertSpecialTags($mock->getBody());

        $response->setContent($convertedBody);
        $response->setStatusCode($mock->getResponseStatus());

        foreach ($mock->getHeaders() as $header) {
            $response->headers->set($header->getHeaderKey(), $header->getHeaderValue());
        }

        return $response;
    }
}
