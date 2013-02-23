<?php

namespace Radio\SongBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $aSongs = $this->getPlaylist();

        $templating = $this->container->get('templating');
        
        return $this->render('SongBundle:Default:index.html.twig', array('songs' => $aSongs));
        
    }

    public function getPlaylist(){
        $content = file_get_contents('list.txt');

        preg_match_all('/\d+\.\s(.+)\s\-\s(.+)\s\((.+)\)\s/', $content, $matches, PREG_SET_ORDER);

        $aPlaylist = array();

        foreach($matches as $match){
            $aPlaylist[] = array('artist' => $match[1], 'title' => $match[2], 'time' => $match[3]);
        }

        return $aPlaylist;
    }
}
