# From v1.x to v2.0

## EnumUniqueId
The `EnumUniqueId` trait now it called `EnumSerialization`.
The `uniqueId()` method now is `serialize()` and returns namespace divided by `::` with enum name istead of `.`

```php
//Before
PureEnum::PENDING->uniqueId(); // 'App\Enums\PureEnum.PENDING'
PureEnum::fromUniqueId('App\Enums\PureEnum.PENDING'); // PureEnum::PENDING
//Now
PureEnum::PENDING->serialize(); // 'App\Enums\PureEnum::PENDING'
PureEnum::unserialize('App\Enums\PureEnum::PENDING'); // PureEnum::PENDING
```


