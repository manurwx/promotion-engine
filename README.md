# Promotions Engine Microservice

The promotion engine has a bunch of affiliate marketing partners that are able to provide discounts on products.

The client application or service can fire a request to the Promotions Engine with various pieces of data.
The engine will then find the best value offerings based on the data it received.

![](doc/images/dia.png)

## Database design

PRODUCT
- id (int)
- price (int)

PROMOTION
- id (int)
- name (string)
- type (string)
- adjustment (float)
- criteria (string|json)

![](doc/images/dia2.png)

### Example data

```text
id: 2
name: Voucher OU812
type: fixed_price_voucher
adjustment: 100
criteria: {"code": "OU812"}
```

```text
id: 1
name: Black Friday half price sale
type: date_range_multiplier
adjustment: 0.5
criteria: {"from": "2021-11-25", "to": "2021-11-28"}
```

### How to start the application

```shell
symfony server:start
docker-compose up -d
```

Run the migrations
```shell
symfony console doctrine:migrations:migrate
```
