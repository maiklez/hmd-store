<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Contact;
use App\Data\Repositories\Repository;

class ContactRepository
{
    public function create(string $name, string $email, string $phone, $related_id, string $related_type)
    {
        $contact = new Contact();

        $contact->fill([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        if($related_type === 'Provider')
        {
            return $this->createProviderContact($contact, $related_id);
        }
        if($related_type === 'Store')
        {
            return $this->createStoreContact($contact, $related_id);
        }

        throw new NotFoundException('contact type not found');
    }

    public function createProviderContact(Contact $contact, $related_id)
    {
        $providerRepo = new ProviderRepository();
        $provider = $providerRepo->findById($related_id);

        $provider->contacts()->save($contact);
    }

    public function createStoreContact(Contact $contact, $related_id)
    {
        $storeRepo = new StoreRepository();
        $store = $storeRepo->findById($related_id);

        $store->contacts()->save($contact);
    }

    public function findById($id)
    {
        $contact = Contact::find($id);
        if (!$contact)
        {
          throw new NotFoundException('contact not found');
        }
        return $contact;
    }

    public function findByEmail($email)
    {
        $contact = Contact::where('email', $email)->first();
        if (!$contact)
        {
          throw new NotFoundException('contact not found');
        }
        return $contact;
    }

    public function getAll()
    {
        $contacts = Contact::all();

        return $contacts;
    }

    public function updateById($id, string $name, string $email, string $phone)
    {
        $contact = $this->findById($id);

        $contact->fill([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        $contact->save();

        return $contact;
    }

    public function deleteById($id)
    {
        $contact = $this->findById($id);

        return $contact->delete();
    }
}
