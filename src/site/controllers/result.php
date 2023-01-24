<?php

use carefulcollab\helpers as helpers;
return function($page, $site, $kirby, $result, $country, $userId, $phaseType) 
{


    if ($result->wasSuccessful)
    {
        $statusType='_taskStatus';
        $pointsAdded=$result->pointsAdded;
        
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
              break;
            }
      
          }
        }   
        if ($result->wasSuccessful&&!empty($resourcesArray))
        {
          $collabType=$page->template();
          $result=helpers\DataHelper::addResourcesToCommons($userId,$resourcesArray,$phaseType,$collabType);
          $statusType="_taskCommonsStatus";
          $pointsAdded+=$result->pointsAdded;
          if (isset($result->maximumPoints)&&$result->maximumPoints===true) $maxPoints='Y';
        }

        $collection = $kirby->collection("guides-content");

        if ($next = $page->next($collection)) 
        {
          $next->go(['query' => [$statusType => 'ok', 'points' =>$pointsAdded, 'maxPoints'=>$maxPoints ]]);
        }
        $page->go(['query' => [$statusType => 'ok', 'points' =>$pointsAdded,'maxPoints'=>$maxPoints ]]);
    }
    else
    {
        //return $platform;
        if ($page=$site->find('error'))
            $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
    }
}
?>