<?php

/* Validate the personal interests form
 * @return boolean
 */
function validPersonalForm()
{
    global $f3;
    $isValid = true;

    if (!validString($f3->get('first')))
    {
        $isValid = false;
        $f3->set("errors['first']", "Please enter your first name");
    }

    if (!validString($f3->get('last')))
    {
        $isValid = false;
        $f3->set("errors['last']", "Please enter your last name");
    }

    if (!validNumber($f3->get('age')))
    {
        $isValid = false;
        $f3->set("errors['age']", "Please enter your age");
    }

    if (!validRadio($f3->get('gender')))
    {
        $isValid = false;
        $f3->set("errors['gender']", "Please select your gender");
    }

    if (!validNumber($f3->get('phone')))
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

    if (!validString($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter your email");
    }

    if (!validList($f3->get('state')))
    {
        $isValid = false;
        $f3->set("errors['state']", "Please select your state");
    }

    if (!validRadio($f3->get('seeking')))
    {
        $isValid = false;
        $f3->set("errors['seeking']", "Please select the gender you're seeking");
    }

    if (!validString($f3->get('biography')))
    {
        $isValid = false;
        $f3->set("errors['biography']", "Please enter your biography");
    }

    return $isValid;
}

/* Validate a food
 * Food must not be empty and may only consist
 * of alphabetic characters.
 *
 * @param String food
 * @return boolean
 */
function validString($text)
{
    return !empty($text) && ctype_alpha($text);
}

/* Validate quantity
 * Quantity must not be empty and must be a number
 * greater than 1.
 *
 * @param String qty
 * @return boolean
 */
function validNumber($text)
{
    echo !empty($text);
    echo ctype_digit($text);
    echo $text >= 1;

    return !empty($text) && ctype_digit($text) && $text >= 1;
}

/* Validate a meal
 *
 * @param String meal
 * @return boolean
 */
function validRadio($radio)
{
    if (isset($radio))
    {
        return true;
    }
    return false;
}

function validList($list)
{
    if (isset($list))
    {
        return true;
    }
    return false;
}