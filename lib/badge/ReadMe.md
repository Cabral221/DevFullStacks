# Systeme de badge

- Ajouter le comportement Badgeable au model User `use Badgeable;`
- Creer une migration qui étend de `BadgeMigration`
- Rajouter le Subscriber dans l'`EventServiceProvider.php` 

```php
    protected  $subscribe = [
        BadgeSubscriber::class
    ];
```