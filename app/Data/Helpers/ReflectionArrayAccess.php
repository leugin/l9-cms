<?php

namespace App\Data\Helpers;

trait ReflectionArrayAccess
{
    public function toArray():array {
        $rf = new \ReflectionClass($this);
        $fields =  [];

        foreach ($rf->getProperties() as $value ) {
            $val = $this->{$value->name};
            if (!is_null($val)) {
                $key = $value->name;
                $fields[$key]= $val;
            }
        }
        return  $fields;
    }
}
