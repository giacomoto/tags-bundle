# Luckyseven Validation Bundle
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
todo
