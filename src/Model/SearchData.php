<?php
namespace App\Model;

class SearchData
{
  public $page = 1;
  public ?string $q = "";
  public function getQ(): ?string
  {
      return $this->q;
  }

}