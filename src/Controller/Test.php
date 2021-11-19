<?php

namespace App\Controller;

//use App\Entity\Intervenant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test extends AbstractController
{
function pageTest (){
    return new Response("Page de test");
}
}