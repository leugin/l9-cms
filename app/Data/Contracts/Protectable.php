<?php

namespace App\Data\Contracts;


interface Protectable
{
    public function getSlugPermission():string;
    public function getLabel():string;
 }
