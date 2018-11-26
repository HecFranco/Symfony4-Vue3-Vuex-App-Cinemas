<?php

namespace App\Utils;


class DateTimeUtils
{
  private function changeHourFormat($movieShowingTimesHourToShow){
    $array = explode(":", $movieShowingTimesHourToShow);
    $movieShowingTimesHourToShow = $array[0].':'.$array[1];
    return $movieShowingTimesHourToShow;
  }
}