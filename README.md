## How to use
- Get a cup of coffee & some nicotines
- Create .env file
- Run command "composer i"
- Run command "npm i"
- Run command "npm run dev"
- uncomment file app\Providers\AppServiceProvider.php line 30 - 39

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## How to install
- Get a cup of coffee & some nicotines
- Create .env file
- Pull sub-modules
- Run command "composer i"
- Run command "npm i"
- Run command "npm run dev"

## Deployment
- Generate deploy key
- Add deploy key
- Create ssh config
- Pull project
- Override sub modules url (.gitmodules)
- Install

## Related
#### Sub Modules
* [Landing Page](https://github.com/KMI-UNS-2021-X-CMS/Polres-Landing_page.git)

#### Pull sub-modules via cli
```bash
 git submodule
 git submodule update --init --recursive
```

#### Override sub-module
```
[submodule "name"]
          path = directory/mysubmodule
          url = git@github-sub-module.com:user/repository
```

#### SSH config sample
```
Host github-project.com
        Hostname github.com
        IdentityFile=~/.ssh/your_deploy_key
        
Host github-sub-module.com
        Hostname github.com
        IdentityFile=~/.ssh/your__submodule_deploy_key
```

#### Important Links
* [Generate new ssh key](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent#generating-a-new-ssh-key)
* [Managing deploy key](https://docs.github.com/en/developers/overview/managing-deploy-keys#deploy-keys)
