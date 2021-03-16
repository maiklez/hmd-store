<?php

namespace App\Services\ContactsManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\ContactsManagement\Features\ListContactsFeature;
use App\Services\ContactsManagement\Features\CreateContactFeature;
use App\Services\ContactsManagement\Features\ReadContactFeature;
use App\Services\ContactsManagement\Features\UpdateContactFeature;
use App\Services\ContactsManagement\Features\DeleteContactFeature;

class ContactController extends Controller
{

    public function getContacts()
    {
        return $this->serve(ListContactsFeature::class);
    }

    public function createContact()
    {
        return $this->serve(CreateContactFeature::class);
    }

    public function readContact($id)
    {
        return $this->serve(ReadContactFeature::class, [ 'id' => $id]);
    }

    public function updateContact($id)
    {
        return $this->serve(UpdateContactFeature::class, [ 'id' => $id]);
    }

    public function deleteContact($id)
    {
        return $this->serve(DeleteContactFeature::class, [ 'id' => $id]);
    }
}
