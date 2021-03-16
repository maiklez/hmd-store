## Install

Commands to install, migrate database and seed, run tests and serve in localhost
```
composer install
php artisan migrate:fresh --seed
phpunit
php artisan serve
```

- Attributes CRUD
```
GET - /api/attributes
POST - /api/attributes
GET - /api/attributes/{id}
PUT - /api/attributes/{id}
DELETE - /api/attributes/{id}
```

- Categories CRUD
```
GET - /api/categories
POST - /api/categories
GET - /api/categories/{id}
PUT - /api/categories/{id}
DELETE - /api/categories/{id}
```

- Clients CRUD
```
GET - /api/clients
POST - /api/clients
GET - /api/clients/{id}
PUT - /api/clients/{id}
DELETE - /api/clients/{id}
```

- Contacts CRUD
```
GET - /api/contacts
POST - /api/contacts
GET - /api/contacts/{id}
PUT - /api/contacts/{id}
DELETE - /api/contacts/{id}
```

- Order CRUD
```
GET - /api/orders
POST - /api/orders
GET - /api/orders/{id}
PUT - /api/orders/{id}
DELETE - /api/orders/{id}
POST - /api/orders/{id}/products
```

- ProductAttribute CRUD
```
GET - /api/product-attributes
POST - /api/product-attributes
GET - /api/product-attributes/{id}
PUT - /api/product-attributes/{id}
DELETE - /api/product-attributes/{id}
```

- Store CRUD
```
GET - /api/stores
POST - /api/stores
GET - /api/stores/{id}
PUT - /api/stores/{id}
DELETE - /api/stores/{id}
GET - /api/stores/orders/top-sellers
GET - /api/stores/top-billing
```

- Products CRUD
```
GET - /api/products
POST - /api/products
GET - /api/products/{id}
PUT - /api/products/{id}
DELETE - /api/products/{id}
GET - /api/products/types/{type}/values/{value}
GET - /api/products/best-sellers
```

- Providers CRUD
```
GET - /api/providers
POST - /api/providers
GET - /api/providers/{id}
PUT - /api/providers/{id}
DELETE - /api/providers/{id}
GET - /api/providers/{id}/products
GET - /api/providers/orders/top-billing
```
## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
