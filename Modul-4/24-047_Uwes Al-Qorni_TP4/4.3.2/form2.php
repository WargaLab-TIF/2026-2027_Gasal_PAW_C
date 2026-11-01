<?php

$errors = array();

if (isset($_POST['surname']) || isset($_POST['email']))
{
    require 'validate2.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');

    if ($errors)
    {
        echo '<h3>Invalid, correct the following errors:</h3>';

        foreach ($errors as $field => $error)
        {
            echo "$field $error<br>";
        }

        include 'form2.inc';
    }
    else
    {
        echo 'Form submitted successfully with no errors.';
    }
}
else
{
    include 'form2.inc';
}

?>