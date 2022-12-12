<?php
use carefulcollab\helpers as helpers;
return function($page) 
{
    $forTeachers = $page->siblings()->find('for-teachers');
    $forStudents  = $page->siblings()->find('for-students');
    
    return(compact('forTeachers', 'forStudents'));
};