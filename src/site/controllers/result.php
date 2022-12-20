<?php

use carefulcollab\helpers as helpers;
return function($page, $site, $kirby, $result, $country, $userId, $phaseType) 
{


    if ($result->wasSuccessful)
    {
        $statusType='_taskStatus';
        $pointsAdded=$result->pointsAdded;
        //check for commons upload
        if (isset($result->pointsAdded)) $pointsAdded=$result->pointsAdded;
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
          $collabType=get('collabType');
          $result=helpers\DataHelper::addResourcesToCommons($userId,$resourcesArray,$phaseType,$collabType);
          $statusType="_taskCommonsStatus";
          $pointsAdded+=$result->pointsAdded;
        }

        $collection = $kirby->collection("guides-content");

        if ($next = $page->next($collection)) 
        {
          $next->go(['query' => [$statusType => 'ok', 'points' =>$pointsAdded ]]);
        }
        $page->go(['query' => [$statusType => 'ok', 'points' =>$pointsAdded ]]);
    }
    else
    {
        //return $platform;
        if ($page=$site->find('error'))
            $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
    }
}
?>