<?php

namespace App\Bridge\NewsAPI\Request;

abstract class AbstractRequest
{
    public function toArray(): array
    {
        $data = [];
        foreach( get_object_vars($this) as $attribute ) {
            if(empty($this->$attribute)) {
                $data[''.$attribute] = $this->$attribute;
            }
        }
        return $data;
    }
}
