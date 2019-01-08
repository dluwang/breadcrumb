#  **Breadcrumb**

This is a package that provide service to build breadcrumb.

## **Installation**

```
composer require nagasari/breadcrumb
```

## **Usage**
**Define Navigation**
`Nagasari/Breadcrumb/Crumb`  is  a class to define your crumb. The `__construct` method has three mandatory arguments and one optional arguments

```php
public function __construct($id, $label, $url, Crumb $prev = null)
```

 1. `$id` is the id of the crumb
 2. `$label`  is the label of the crumb
 3. `$url` is the url of the crumb
 4. `$prev` is the previous crumb of current crumb

All of the properties above can be accessed via the object instance.

**Registering previous crumb**
There are two methods to register previous crumb.

 - **Via constructor**

    `$crumb = new Crumb('the-id', 'the-lable', 'the-url', $prev);`

 - **Via prev() method**
    `$crumb->prev($prevCrumb);`

**Cast to array**

```php
$crumb->toArray();

results: [['crumb-1', 'crumb 1', '/crumb-1'], ['crumb-2', 'crumb 2', '/crumb-2']]
```

If your crumb is build in recursive manner, it will generate all of the prev crumb.

## **Define Breadcrumb**
`Nagasari/Breadcrumb/Breadcrumb`  is an interface that act as the repository of Crumb. All Breadcrumb implementation should implements `Nagasari/Breadcrumb/Breadcrumb` interface. Currently. this package provide in memory implementation which is located at `Nagasari/Breadcrumb/InMemoryBreadcrumb`.

```php
$breadcrumb = new InMemoryBreadcrumb()
```
Constructor has one optional argument which is the crumbs that registered.

**Registering crumbs**

```php
$breadcrumb->register($crumb) // single crumb registration
$navigator->register([$crumb1, $crumb2]) // mutiple crumbs
```

As mentioned above, the deferred child can be registered casually to navigator.

**Retrieve crumb by id**

```php
$breadcrumb->crumb('crumb-id')
```

**Global previous crumb**

Sometimes you need to apply previous to all crumbs. Below is how to achieve that.

```php
$global = new Crumb('the-id', 'the-label', 'the-url');
$breadcrumb->prev($global);
```

## **Integration**

Currently, this package only integrated with **laravel framework**. The integration only register default implementation binding (in memory implementation) and provide an alias.

#### **Tests**
To run test, run this following command

```
vendor/bin/phpunit
```