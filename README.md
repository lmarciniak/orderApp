# orderApp

### Ten dokument zapewnia instrukcję uruchomienia i krótki przegląd korzystania z API do tworzenia i pobierania zamówień
### Instrukcja uruchomienia:
1. W bieżącym katalogu uruchom ``docker compose up -d`` aby zbudować i uruchomić kontenery.
2. Wejdź do kontenera z aplikacją symfony i wykonaj migrację startową\
    ``docker exec -it php bash``\
    ``bin/console doctrine:migrations:migrate``
3. Załaduj dane testowe (opcjonalnie)\
    ``bin/console doctrine:fixtures:load``

### Endpointy:
1. Tworzenie zamówienia\
   **URL**: /order\
   **Metoda**: POST\
   **Przykład użycia**:
   ```
   curl -X POST http://localhost:8000/order \
    -H "Content-Type: application/json" \
    -d '{
    "orderItems": [
        {
            "productId": 1,
            "quantity": 2
        },
        {
            "productId": 3,
            "quantity": 1
        },
        {
            "productId": 7,
            "quantity": 4
        }
    ]}'
    ```
   **Przykładowe żądanie**:
```json
{
  "orderItems": [
    {
      "productId": 1,
      "quantity": 2
    },
    {
      "productId": 3,
      "quantity": 1
    },
    {
      "productId": 7,
      "quantity": 4
    }
  ]
}
```
**Przykładowa odpowiedź**:
```json
[
    {
        "id": 3,
        "vatAmount": 220.8,
        "netAmount": 960,
        "totalAmount": 1180.8,
        "orderItems": [
            {
                "id": 6,
                "orderRef": "3",
                "product": {
                    "id": 1,
                    "name": "Product 0",
                    "category": "ELECTRONICS",
                    "price": 100
                },
                "quantity": 2
            },
            {
                "id": 7,
                "orderRef": "3",
                "product": {
                    "id": 3,
                    "name": "Product 2",
                    "category": "ELECTRONICS",
                    "price": 120
                },
                "quantity": 1
            },
            {
                "id": 8,
                "orderRef": "3",
                "product": {
                    "id": 7,
                    "name": "Product 6",
                    "category": "ELECTRONICS",
                    "price": 160
                },
                "quantity": 4
            }
        ]
    }
]
```
**Przykładowa odpowiedź błędu**
```json
{
    "orderItems[0][quantity]": "Product quantity has to be greater than 0."
}
```
2. Zwracanie informacji o zamówieniu\
   **URL**: /order/{id}\
   **Metoda**: GET\
   **Przykład użycia**:\
   ``curl -X GET http://localhost:8000/order/3``

   **Przykładowa odpowiedź**:
```json
{
    "id": 3,
    "vatAmount": 220.8,
    "netAmount": 960,
    "totalAmount": 1180.8,
    "orderItems": [
        {
            "id": 6,
            "orderRef": "3",
            "product": {
                "id": 1,
                "name": "Product 0",
                "category": "ELECTRONICS",
                "price": 100
            },
            "quantity": 2
        },
        {
            "id": 7,
            "orderRef": "3",
            "product": {
                "id": 3,
                "name": "Product 2",
                "category": "ELECTRONICS",
                "price": 120
            },
            "quantity": 1
        },
        {
            "id": 8,
            "orderRef": "3",
            "product": {
                "id": 7,
                "name": "Product 6",
                "category": "ELECTRONICS",
                "price": 160
            },
            "quantity": 4
        }
    ]
}
```
