---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Auth Management

APIs for Auth Management
<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Get a JWT via given credentials.

We dont need bearear token here.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/login" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"est","password":"vel"}'

```
```javascript
const url = new URL("http://localhost/api/v1/login");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "est",
    "password": "vel"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNTYxNDgwOTIyLCJleHAiOjE1NjE0ODQ1MjIsIm5iZiI6MTU2MTQ4MDkyMiwianRpIjoidHZNbHgxdDBaNWdGRjRCMSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.POaqvRrqFaRjf0wrOdPprVPSuHuzlh5BnYeMI8H5-cQ",
    "token_type": "bearer",
    "expires_in": 60,
    "user": {
        "id": 1,
        "name": "Bijay",
        "email": "bj.aspire@gmail.com",
        "email_verified_at": null,
        "created_at": "2019-06-25 07:01:25",
        "updated_at": "2019-06-25 07:01:25"
    }
}
```

### HTTP Request
`POST api/v1/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | required |  optional  | email email
    password | required |  optional  | password password

<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_fb2ae43e2e99ff4e90f22ba03801a735 -->
## Log the user out (Invalidate the token).

> Example request:

```bash
curl -X POST "http://localhost/api/v1/logout" \
    -H "Authorization: Bearer {token}"
```
```javascript
const url = new URL("http://localhost/api/v1/logout");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "message": "Successfully logged out"
}
```

### HTTP Request
`POST api/v1/logout`


<!-- END_fb2ae43e2e99ff4e90f22ba03801a735 -->

<!-- START_5bdff954dc5610e9df807db665298b8e -->
## Refresh a token.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/refresh" \
    -H "Authorization: Bearer {token}"
```
```javascript
const url = new URL("http://localhost/api/v1/refresh");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL3JlZnJlc2giLCJpYXQiOjE1NjE0ODQ2NzMsImV4cCI6MTU2MTQ4ODQ2MywibmJmIjoxNTYxNDg0ODYzLCJqdGkiOiIwT2E4b3hwTTRzTzJvUldlIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.CSG6zcN0Lvof6USFIfhP2EiYq-Pa2DfrPcwHizDrFe8",
    "token_type": "bearer",
    "expires_in": 60,
    "user": {
        "id": 1,
        "name": "Bijay",
        "email": "bj.aspire@gmail.com",
        "email_verified_at": null,
        "created_at": "2019-06-25 07:01:25",
        "updated_at": "2019-06-25 07:01:25"
    }
}
```

### HTTP Request
`POST api/v1/refresh`


<!-- END_5bdff954dc5610e9df807db665298b8e -->

<!-- START_c5e64b712c39685cb2dedfa8eb581a21 -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/me" \
    -H "Authorization: Bearer {token}"
```
```javascript
const url = new URL("http://localhost/api/v1/me");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "name": "Bijay",
    "email": "bj.aspire@gmail.com",
    "email_verified_at": null,
    "created_at": "2019-06-25 07:01:25",
    "updated_at": "2019-06-25 07:01:25"
}
```

### HTTP Request
`POST api/v1/me`


<!-- END_c5e64b712c39685cb2dedfa8eb581a21 -->

#Transaction

APIs for Transaction
<!-- START_9f8e18d33c308f3d513445ca7059fa66 -->
## Transaction listing

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/transaction" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"page":3,"limit":14,"search":{"field":"suscipit","value":"id"}}'

```
```javascript
const url = new URL("http://localhost/api/v1/transaction");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "page": 3,
    "limit": 14,
    "search": {
        "field": "suscipit",
        "value": "id"
    }
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "result": {
        "total": 8,
        "rows": [
            {
                "id": 8,
                "title": "fsda",
                "rate": 12,
                "qty": 12,
                "type": "purchase",
                "author": 2,
                "description": "fdafdasf",
                "created_at": "2019-06-23 13:33:26",
                "updated_at": "2019-06-23 13:33:26"
            },
            {
                "id": 7,
                "title": "fsda",
                "rate": 12,
                "qty": 12,
                "type": "purchase",
                "author": 2,
                "description": "fdafdasf",
                "created_at": "2019-06-23 13:33:25",
                "updated_at": "2019-06-23 13:33:25"
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/transaction`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    page | integer |  optional  | page
    limit | integer |  required  | limit
    search[field] | string |  optional  | 
    search[value] | string |  optional  | 

<!-- END_9f8e18d33c308f3d513445ca7059fa66 -->

<!-- START_6173cfe3b8ca3e377269cf11b896437c -->
## Transaction Create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/transaction" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"title":"delectus","rate":69.8236906,"qty":4,"type":"sunt","author":18,"description":"repellat"}'

```
```javascript
const url = new URL("http://localhost/api/v1/transaction");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "delectus",
    "rate": 69.8236906,
    "qty": 4,
    "type": "sunt",
    "author": 18,
    "description": "repellat"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "result": {
        "id": 5,
        "title": "fsda",
        "rate": 12,
        "qty": 12,
        "type": "sales",
        "author": 1,
        "description": "fdafdasf",
        "created_at": "2019-06-25 10:41:50",
        "updated_at": "2019-06-25 10:41:50"
    }
}
```

### HTTP Request
`POST api/v1/transaction`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | title.
    rate | float |  required  | rate.
    qty | integer |  required  | qty.
    type | string |  required  | type.
    author | integer |  required  | author.
    description | string |  required  | description.

<!-- END_6173cfe3b8ca3e377269cf11b896437c -->

<!-- START_c733d4a7f135bf9eb6629505da7efccf -->
## Transaction Show

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/transaction/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"transaction_id":19}'

```
```javascript
const url = new URL("http://localhost/api/v1/transaction/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "transaction_id": 19
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "result": {
        "id": 5,
        "title": "fsda",
        "rate": 12,
        "qty": 12,
        "type": "sales",
        "author": 1,
        "description": "fdafdasf",
        "created_at": "2019-06-25 10:41:50",
        "updated_at": "2019-06-25 10:41:50"
    }
}
```

### HTTP Request
`GET api/v1/transaction/{transaction}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    transaction_id | integer |  required  | the ID of the transaction

<!-- END_c733d4a7f135bf9eb6629505da7efccf -->

<!-- START_0e43f4511ce82b13e6a4e0afade89d79 -->
## Transaction Update

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/transaction/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"transaction_id":6}'

```
```javascript
const url = new URL("http://localhost/api/v1/transaction/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "transaction_id": 6
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "result": {
        "id": 5,
        "title": "fsda",
        "rate": 12,
        "qty": 12,
        "type": "sales",
        "author": 1,
        "description": "fdafdasf",
        "created_at": "2019-06-25 10:41:50",
        "updated_at": "2019-06-25 10:41:50"
    }
}
```

### HTTP Request
`PUT api/v1/transaction/{transaction}`

`PATCH api/v1/transaction/{transaction}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    transaction_id | integer |  required  | the ID of the transaction

<!-- END_0e43f4511ce82b13e6a4e0afade89d79 -->

<!-- START_c81d986f2ed8173059ff7dd84ff6ee19 -->
## Transaction Delete

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/transaction/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"transaction_id":5}'

```
```javascript
const url = new URL("http://localhost/api/v1/transaction/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "transaction_id": 5
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "result": "null",
    "messages": null
}
```

### HTTP Request
`DELETE api/v1/transaction/{transaction}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    transaction_id | integer |  required  | the ID of the transaction

<!-- END_c81d986f2ed8173059ff7dd84ff6ee19 -->


