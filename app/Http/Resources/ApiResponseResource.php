<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'nam' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'address' => $this->address,
      'photo' => $this->photo,
      'malls' => $this->malls,
    ];
  }
}
