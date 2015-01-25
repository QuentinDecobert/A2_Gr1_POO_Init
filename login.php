<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 14:29
 */


use QuentinDecobert\PokemonBattle\Model\TrainerModel;


require __DIR__.'/vendor/autoload.php';
require __DIR__.'/_header.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/view',
]);

session_start();

if (!empty($_SESSION))
{
//echo 'Forbidden !';
    header('Location: index.php');
    die;
}



/** @var $em \Doctrine\ORM\EntityManager */
$em = require __DIR__.'/bootstrap.php';

if(isset($_POST['username']) && $_POST['password'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    /**
     * Login
     */
    if (null !== $username && null !== $password)
    {
        /** @var \Doctrine\ORM\EntityRepository $userRepository */
        $userRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
        /** @var TrainerModel|null $user */
        $user = $userRepository->findOneBy([
            'username' => $username,
            'password' => $password,
        ]);

        if (!empty($user))
        {
            $_SESSION['id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['connected'] = true;
            if (!empty($_SESSION)) {
//echo 'Forbidden !';
                header('Location: index.php');
                die;
            }
        } else
            echo "Bad Credential";

    }
}


$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


    echo $twig->render('login.html.twig', [




    ]);

