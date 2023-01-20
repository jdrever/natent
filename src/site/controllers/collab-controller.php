<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    $userId=$platform['userId'];
    $callingPage=$_SERVER['HTTP_REFERER'];


    $collaborationPointType = $_POST['point'];
    if ($collaborationPointType == 'Comment')
    {
      $contentType = $_POST['contentType'];
      $contentId = $_POST['contentId'];
      $comment = htmlspecialchars($_POST['comment']);
      $result=helpers\DataHelper::addComment($userId, $contentType, $contentId, $comment);
      if ($result->wasSuccessful==true)
      {
        $maxPoints='N';
        if (isset($result->maximumPoints)&&$result->maximumPoints===true) $maxPoints='Y';
        Response::go(getRedirectUrl($callingPage, '_commentStatus=ok&points=' . $result->pointsAdded . '&pointsOther=' . $result->pointsAddedOtherTeam . '&maxPoints=' .$maxPoints));
      }
    }
    if ($collaborationPointType == 'Appreciate')
    {
      $contentType = $_POST['contentType'];
      $contentId = $_POST['contentId'];
      $result=helpers\DataHelper::addAppreciation($userId, $contentType, $contentId);
      if ($result->wasSuccessful==true)
      {
        $maxPoints='N';
        if (isset($result->maximumPoints)&&$result->maximumPoints===true) $maxPoints='Y';
        Response::go(getRedirectUrl($callingPage, '_appreciationStatus=ok&points=' . '&pointsOther=' . $result->pointsAddedOtherTeam . '&maxPoints=' .$maxPoints));
      }
    }
  
    if ($collaborationPointType == 'Recommend')
    {
      $resourceId = $_POST['resourceId'];
      $recommend=$_POST['recommend'];
      $result=helpers\DataHelper::setCommonsResourceRecommendation($userId, $resourceId, $recommend);
      if ($result->wasSuccessful==true)
      {
        Response::go(getRedirectUrl($callingPage, '_recommendStatus=ok'));
      }
    }


};

function getRedirectUrl($page, $queryString)
{
  //first remove anything beyond the _ which marks the start of the collaboration query strings
  $page=strtok($page, "_");
  //then check whether a & has been left before the collaboration query string
  if (substr($page,-1)=="&")
    $page=substr($page,0,-1);

  //then make sure to use either a ? or a & depending on whether there is an existing query string
  $linkChar='?';
  if (strpos($page,'?')!==false)
  {
    $linkChar='&';
  }
  return $page . $linkChar . $queryString;
}