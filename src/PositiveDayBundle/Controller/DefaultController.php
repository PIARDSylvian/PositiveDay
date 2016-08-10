<?php

namespace PositiveDayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PositiveDayBundle\Entity\Post;
use PositiveDayBundle\Entity\Comment;
use PositiveDayBundle\Form\PostType;
use PositiveDayBundle\Form\CommentType;
use DateTime;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {	
    	$em = $this->getDoctrine()->getManager();

    	//récuperation de l'utilisateur courant.
        $user=$this->getUser();
        $iduser=$user->getId();

        //appel des 3 dernier post.
		$last = $em->getRepository('PositiveDayBundle:Post')->findBy(
			array('user'=>$user),
			array('id'=>'desc'),
			3,
			0
		);

        //definition d'une nouvelle instance d'entité post
    	$post = new Post;
    	//appel du form
		$form = $this->get('form.factory')->create(new PostType, $post);
        $form->handleRequest($request);

		
		$current_date = new datetime();
		//on test si la date actuel n est pas equivalante a la date du dernier post
		if (($last[0]->getDate()->format('m/d'))==$current_date->format('m/d')){
			$validate_date=0;
		}
		else{
			$validate_date=1;
		}

		if($validate_date!=0){

			if ($form->isSubmitted() && $form->isValid()) {	

				//atribution de la date du jour
				$post->setDate(new datetime());

				//atribution de l'id user
				$post->setUser($user);

				$em->persist($post);
				$em->flush();

				$request->getSession()->getFlashBag()->add('success', 'Post enregistré.');
			}
		}

		else{
			$request->getSession()->getFlashBag()->add('success', 'Post déja envoyé attendez demain.');
		}

        return $this->render('PositiveDayBundle::index.html.twig', array(
			'form' => $form->createView(),
			'last' => $last,
			'validate_date' => $validate_date,

		));
    }
    
    public function addcomAction(Request $request, $id)
    {	
    	$em = $this->getDoctrine()->getManager();

    	//récuperation de l'utilisateur courant.
        $user=$this->getUser();
        $iduser=$user->getId();

        $comment = $request->request->get('comment');

        //definition d'une nouvelle instance d'entité post
    	$com = new Comment;

		$post=$em->getRepository('PositiveDayBundle:Post')->findOneById($id);
		
		$com->setContent($comment);
		//attribution de la date du jour
		$com->setDate(new datetime());
		//attribution de user
		$com->setUser($user);
		//attribution de post
		$com->setPost($post);

		$em->persist($com);
		$em->flush();

		$request->getSession()->getFlashBag()->add('success', 'Commentaire enregistré');

        return $this->redirectToRoute('index');
    }
}
