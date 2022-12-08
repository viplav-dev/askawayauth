<?php
defined('BASEPATH') or exit('No direct script access allowed');
// helpers messasges

function messages()
{
    $message = array(
        'enterValidEmailPass' => 'Please enter valid email and password ',
        'userNotExists' => 'No user is registered with this email id',
        'userExists' => 'User already exists with this email id',
        'userNotActive' => 'User is not active',
        'userActive' => 'User is active',
        'invalidUserEmailPass' => 'That was an invalid email or password. Try again!',
        'logoutSuccess' => 'You have been Signed out successfully',
        'passwordAdded' => 'Password added successfully',
        'passwordNotAdded' => 'Password not added',
        'passwordUpdated' => 'Password updated successfully',
        'passwordNotUpdated' => 'Password not updated',
        'passwordDeleted' => 'Your password is deleted successfully',
        'passwordNotDeleted' => 'Password not deleted',
        'checkDetails' => 'Oh! Please check your details',
        'passwordNotFound' => 'Oh Snap! Password not found',
        'resetLinkNotSent' => 'Reset link not sent',
        'resetLinkSent' => 'Reset link sent successfully',
        'invalidLink' => 'This link is either invalid or has expired.',
        'passwordNotMatch' => 'Password does not match',
        'passwordNotChanged' => 'It\'s not you, it\'s us. Please try again later.',
        'passwordChanged' => 'Yay! You have successfully changed your password.',
        'loginSuccessful' => 'Yay! You have successfully logged in.',
        'alreadyLoggedIn'  => 'Uh Oh! Active session found. <br> Please logout to perform this operation.',
        'registerSuccess' => 'Yay! You have successfully registered.',
        'registerFailed' => 'Uh Oh! Registration failed. Please try again later.'


    );

    return $message;
}
