# Luckyseven Tags Bundle
Luckyseven Tags Bundle

## Update composer.json and register the repositories
```
{
    ...
    "repositories": [
        {"type": "git", "url":  "https://github.com/giacomoto/tags-bundle.git"}
    ],
    ...
    "extra": {
        "symfony": {
            ...
            "endpoint": [
                "https://api.github.com/repos/giacomoto/tags-recipes/contents/index.json",
                "flex://defaults"
            ]
        }
    }
}
```

## Install
```
composer require symfony/orm-pack

composer require luckyseven/tags:dev-main
composer recipes:install luckyseven/tags --force -v
```

## Usage
Create the Entity `Tag.php` to extend the bundle entity superclass.
```php
<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\Tag as L7Tag;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag extends L7Tag
{
}

```
Create the Repository `TagRespository.php` to extend the bundle repository
```php
<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Luckyseven\Bundle\LuckysevenTagsBundle\Repository\TagRepository as L7TagRepository;

class TagRepository extends L7TagRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }
}
```
Implements the interface `Luckyseven\Bundle\LuckysevenTagsBundle\Interface\IEntityHasTags` with the entity you want to support tags

Lastly, `php bin/console make:migration`
