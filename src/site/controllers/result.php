<?php

use carefulcollab\helpers as helpers;
return function($page, $site, $kirby, $result, $country, $userId, $phaseType) 
{

    if ($result->wasSuccessful)
    {
        $statusType='_taskStatus';
        $pointsAdded=$result->pointsAdded;
        $statusResult='ok';
        
        $maxPoints='N';
        if (isset($result->maximumPoints)&&$result->maximumPoints===true) $maxPoints='Y';

        //check for commons upload

        $resourcesArray = array();
        for ($x = 1; $x <= 4; $x++)
        {
          if (!empty($_POST['resourceTitle' . $x]))
          {
      
            $fileUploadResult=helpers\FileHelper::uploadFiletoS3('fileUpload' .$x);
            
            if ($fileUploadResult->wasSuccessful)
            {       
              $title = $_POST['resourceTitle' . $x];
              $description = $_POST['resourceDescription' . $x];
              $url = $_POST['resourceUrl' . $x];
              $resource = new helpers\CommonsResource();
              $resource->title=$title;
              $resource->description=$description;
              $resource->url=$url; 
              $resource->fileUploadURL=$fileUploadResult->fileURL;
              $resourcesArray[]=$resource; 
            }
            else
            {
              $result->wasSuccessful=false;
              $result->errorMessage=$fileUploadResult->errorMessage;
              $statusResult='error';
            }
      
          }
        }   
        if ($result->wasSuccessful&&!empty($resourcesArray))
        {
            $collabType=$page->template();
            $statusType="_taskCommonsStatus";
            $result=helpers\DataHelper::addResourcesToCommons($userId,$resourcesArray,$phaseType,$collabType);
            if ($result->wasSuccessful)
            {
              $pointsAdded+=$result->pointsAdded;
              if (isset($result->maximumPoints)&&$result->maximumPoints===true) $maxPoints='Y';
            }
            else
            {
              $statusResult='error';
            }
        }
    }
    else
    {
      $statusResult="error";
    }

    $collection = $kirby->collection("guides-content");

    if ($next = $page->next($collection)) 
    {
      $next->go(['query' => [$statusType => $statusResult, 'points' =>$pointsAdded, 'maxPoints'=>$maxPoints, 'message'=>$result->errorMessage ]]);
    }
    $page->go(['query' => [$statusType => $statusResult, 'points' =>$pointsAdded,'maxPoints'=>$maxPoints, 'message'=>$result->errorMessage ]]);
}
?>