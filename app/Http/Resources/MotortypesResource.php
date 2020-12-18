<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MotortypesResource
 * @package App\Http\Resources
 */
class MotortypesResource extends ResourceCollection
{
    /**
     * Transform the motor types collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [];
        $data = $this->collection->toArray();
        foreach ($data as $key => $object)
        {
            $response['data'][] = [
                'id' => $object->id,
                'name' => $object->name,
                'urlname' => $object->urlname
            ];
        }

        return $response;
    }
}
