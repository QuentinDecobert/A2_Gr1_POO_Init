<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 14:30
 */


require __DIR__.'/vendor/autoload.php';
require __DIR__.'/_header.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/view',
]);



use Cocur\Slugify\Slugify;
use QuentinDecobert\PokemonBattle\Model\TrainerModel;

session_start();

/**
 * Protection
 */
if (!empty($_SESSION['connected'])) {
//echo 'Forbidden !';
    header('Location: index.php');
    die;
}
/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__.'/bootstrap.php';


$username = !empty($_POST['username']) ? $_POST['username'] : null;
$password = !empty($_POST['password']) ? $_POST['password'] : null;
/**
 * SignIn
 */
if (null !== $username && null !== $password) {
$user = new TrainerModel();
$user
->setUsername($username)
->setPassword($password)
;
$em->persist($user);
$em->flush();
echo 'User created!';
}

/**
 * Login
 */
if (!empty($username) && empty($password)) {
    /** @var \Doctrine\ORM\EntityRepository $userRepository */
    $userRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
    /** @var TrainerModel|null $user */
    $user = $userRepository->findOneBy([
        'username' => $username,
        'password' => $password,
    ]);
    if (!empty($user)) {
        $_SESSION['id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['connected'] = true;
        header("location: index.php");
    }
}


$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


echo $twig->render('register.html.twig');