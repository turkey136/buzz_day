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
docker-compose run --rm php npm run dev
```

- docker コンテナの起動

```
cd docker-compose
docker-compose up
```

- 今日の急上昇の取得

```
cd docker-compose

# Youtube
docker-compose run --rm php php artisan command:scrapingYoutube

# ニコニコ動画
docker-compose run --rm php php artisan command:scrapingNiconico
```

- ページ追加後

```
cd docker-compose
docker-compose run --rm php ./script/clear_cache.sh
docker-compose run --rm php npm run dev
```
