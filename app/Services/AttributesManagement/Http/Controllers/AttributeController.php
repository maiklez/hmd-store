<?php

namespace App\Services\AttributesManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\AttributesManagement\Features\ListAttributesFeature;
use App\Services\AttributesManagement\Features\CreateAttributeFeature;
use App\Services\AttributesManagement\Features\ReadAttributeFeature;
use App\Services\AttributesManagement\Features\UpdateAttributeFeature;
use App\Services\AttributesManagement\Features\DeleteAttributeFeature;

class AttributeController extends Controller
{

    public function getAttributes()
    {
        return $this->serve(ListAttributesFeature::class);
    }

    public function createAttribute()
    {
        return $this->serve(CreateAttributeFeature::class);
    }

    public function readAttribute($id)
    {
        return $this->serve(ReadAttributeFeature::class, [ 'id' => $id]);
    }

    public function updateAttribute($id)
    {
        return $this->serve(UpdateAttributeFeature::class, [ 'id' => $id]);
    }

    public function deleteAttribute($id)
    {
        return $this->serve(DeleteAttributeFeature::class, [ 'id' => $id]);
    }
}
