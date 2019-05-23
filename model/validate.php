<?php

/* Validate the personal interests form
 * @return boolean
 */
function validPersonalForm()
{
    global $f3;
    $isValid = true;

    if (!validName($f3->get('first')))
    {
        $isValid = false;
        $f3->set("errors['first']", "Please enter your first name");
    }

    if (!validName($f3->get('last')))
    {
        $isValid = false;
        $f3->set("errors['last']", "Please enter your last name");
    }

    if (!validAge($f3->get('age')))
    {
        $isValid = false;
        $f3->set("errors['age']", "Please enter your age");
    }

    if (!validPhone($f3->get('phone')))
    {
        $isValid = false;
        $f3->set("errors['phone']", "Please enter your phone number");
    }

    return $isValid;
}

/* Validate the personal interests form
 * @return boolean
 */
function validProfileForm()
{
    global $f3;
    $isValid = true;

    if (!validEmail($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter your email");
    }

    return $isValid;
}

/* Validate the personal interests form
 * @return boolean
 */
function validInterestsForm()
{
    global $f3;
    $isValid = true;

    if (!validIndoor($f3->get('indoor'))) {
        $isValid = false;
        $f3->set("errors['indoor']", "Please select at least one indoor activity");
    }

    if (!validOutdoor($f3->get('outdoor'))) {
        $isValid = false;
        $f3->set("errors['outdoor']", "Please select at least one outdoor activity");
    }

    return $isValid;
}

//checks to see that a string is all alphabetic
function validName($name)
{
    //allow spaces in case user has multiple names
    $name = str_replace(" ", "", $name);
    return !empty($name) && ctype_alpha($name);
}

//checks to see that an age is numeric and between 18 and 118
function validAge($age)
{
    return !empty($age) && ctype_digit($age) && ($age >= 18 && $age <= 118);
}

//checks to see that a phone number is valid (you can decide what constitutes a “valid” phone number)
function validPhone($phone)
{
    return !empty($phone) && ctype_digit($phone) && strlen($phone) == 10;
}

//checks to see that an email address is valid
function validEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return false;
    }
    return true;
}

//checks each selected indoor interest against a list of valid options
function validIndoor($indoor)
{
    if (!empty($indoor) && isset($indoor))
    {
        return true;
    }
    return false;
}

//checks each selected outdoor interest against a list of valid options
function validOutdoor($outdoor)
{
    if (!empty($outdoor) && isset($outdoor))
    {
        return true;
    }
    return false;
}