<?php

namespace App\Bridge\NewsAPI\Request;

abstract class AbstractRequest
{
    public function __construct(?array $data = null)
    {
        if(!empty($data)) {
            $attributes = array_keys(get_object_vars($this));
            foreach($data as $key => $value) {
                if(in_array($key, $attributes)) {
                    $this->$key = $value;
                }
            }
        }
    }    

    public function toArray(): array
    {
        $data = [];
        foreach( array_keys(get_object_vars($this)) as $attribute ) {
            if(null !== $this->$attribute) {
                if($this->$attribute instanceof \DateTimeInterface) {
                    $data[''.$attribute] = $this->$attribute->format('Y-m-d H:i:s');
                    continue;    
                }
                $data[''.$attribute] = $this->$attribute;
            }
        }
        return $data;
    }
}
