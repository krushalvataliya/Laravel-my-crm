# Custom Fields

[[toc]]

## Overview

Custom fields can be associated to Eloquent models to allow custom data to be stored. You can use these fields to store any additional custom data you would like to collect in your CRM without needing to add fields to the core tables.

## Fields

```php
Kv\MyCrm\Models\Field
```

|Field|Description|
|:-|:-|
|`type`|Field type|
|`name`|Field name|
|`label`|Field label|
|`required`|Boolean|
|`default`||
|`validation`||

## Field Groups