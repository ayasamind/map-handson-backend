# Map Maker Backend

## 環境構築

```
$ cp .env.dev .env

$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

$ docker-compose up -d

http://localhost:8888/ にアクセス

http://localhost:8888/api/health にアクセス
```


## API Document生成

https://map-maker.fusic.co.jp/document/

```
$ vendor/bin/openapi app/ -o storage/swagger.yaml -c operationId.hash=false // swagger.ymlを生成

$ npx redoc-cli build ./storage/swagger.yaml -o public/document/index.html // swagger.ymlを元にHTMLファイルを生成
```
