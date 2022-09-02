## 開発環境構築

- docker コンテナの構築

```
cd docker-compose
docker-compose build
```

- アプリセットアップ

```
cd docker-compose
docker-compose run --rm php composer install
docker-compose run --rm php npm install
docker-compose run --rm php php artisan storage:link
```

- docker コンテナの起動

```
cd docker-compose
docker-compose up
```

- 今日の YouTube 急上昇の取得

```
cd docker-compose
docker-compose run --rm php php artisan command:scrapingYoutube
```

composer create-project "laravel/laravel=9.\*" ./
