<?php
/**
 * Created by PhpStorm.
 * User: Quill McConnell
 * Date: 4/12/2019
 * Time: 2:16 PM
 * Description: The controller for my dating website
 */

// Turn on error reporting
ini_set('display_error', 1);
error_reporting(E_ALL);

//require autoload file
require_once ('vendor/autoload.php');
require_once('model/validate.php');

// create an instance of the base class
$f3 = Base::instance();

// Turn on Fat-free error reporting
$f3->set('DEBUG', 3);

// define a default route
$f3->route('GET /', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
});

// define a personal information route
$f3->route('GET|POST /personal', function($f3)
{
    //If form has been submitted, validate
    if(!empty($_POST))
    {
        //Get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        //Add data to hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);

        //If data is valid
        if (validPersonalForm())
        {
            //Write data to Session
            $_SESSION['first'] = $first;
            $_SESSION['last'] = $last;
            $_SESSION['age'] = $age;
            if(!isset($_POST['gender']))
            {
                $_SESSION['gender'] = "No gender selected";
            }
            else
            {
                $_SESSION['gender'] = $gender;
            }
            $_SESSION['phone'] = $phone;

            //Redirect to Summary
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->set('allStates', array("Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware",
    "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana",
    "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
    "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio",
    "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas",
    "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"));
// define a profile route
$f3->route('GET|POST /profile', function($f3)
{
    //If form has been submitted, validate
    if(!empty($_POST))
    {
        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $biography = $_POST['biography'];

        //Add data to hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('seeking', $seeking);
        $f3->set('biography', $biography);

        //If data is valid
        if (validProfileForm())
        {
            //Write data to Session
            $_SESSION['email'] = $email;
            if(!isset($_POST['state']))
            {
                $_SESSION['state'] = "No state selected";
            }
            else
            {
                $_SESSION['state'] = $state;
            }
            if(!isset($_POST['seeking']))
            {
                $_SESSION['seeking'] = "No seeking selected";
            }
            else
            {
                $_SESSION['seeking'] = $seeking;
            }
            $_SESSION['biography'] = $biography;

            //Redirect to Summary
            $f3->reroute('/interests');
        }
    }

    $view = new Template();
    echo $view->render('views/form2.html');
});

// define a interests route
$f3->route('GET /interests', function($f3)
{
    $view = new Template();
    echo $view->render('views/form3.html');
});

// define a summary route
$f3->route('GET /summary', function()
{
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();
