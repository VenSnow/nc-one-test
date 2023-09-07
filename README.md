# NC1 Test task


### Installation

`composer install`

`cp .env.example .env`

`php artisan key:generate`

`php artisan migrate --seed`

`npm install && npm run build`


You have to set `VITE_BASE_URL` in the `.env` file

Technologies: Laravel 10, VueJs3, ElementUI (Element Plus), GraphQL

This application have a GraphQL

Graphiql url is your_url/graphiql

GraphQL have only one type `Apartment` and two queries `Items` and `Item`

Instruction:

For get apartment where price is more than 300 000 you have to set this query:

```
query {
    Apartments(price_from: 300000) {
        name,
        price,
    }
}
```

For get specific apartment with ID you have to set this query:

```
query {
    Apartment(id: 1) {
        id,
        name,
        price,
     }
}

```
