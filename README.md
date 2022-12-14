# Master class

This is a project the has every master class since novembre of 2023

## Installation

### step 1 run container
```bash
 dockerc-composer up -d
```

### step 2 install dependencies
inside of container run 
```bash
 composer install
```
### step 3
create admin
```bash
  php artisan management:admin:create demo@demo.com {some password}
```
### step 4
set permission
```bash
 php artisan management:admin:assign demo@demo.com --all=true
```

## Usage
inside container run
```
 npm run dev
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
