# laravel_gpi_public

## 参考URL

[Elixirをdocker環境で立ち上げてみる。](https://qiita.com/naritomo08/items/fecf4ace7b9ca9078102)

[LaravelとChatGPT APIの強力コラボ！関連データ検索がこれで簡単・効率的になる！](https://blog.capilano-fw.com/?p=11642#i-8)

## 事前準備

mac+DockerCompose+vscodeでの環境を構築してること。

参考URLを参考にchatgpt APIキーを入手していること。

## 環境構築手順

### 本リポジトリをクローンする。

```bash
$ git clone -b php8.2 https://github.com/naritomo08/laravel_docker.git laraveldocker
$ cd laraveldocker
$ git clone https://github.com/naritomo08/laravel_gpt_public.git backend
```

後にファイル編集などをして、git通知が煩わしいときは
作成したそれぞれのフォルダで以下のコマンドを入れる。

```bash
 rm -rf .git
```

### APIキーを登録する。

```bash
 vi env.example

OPENAI_API_KEY=
→APIキーを追記する。
```

### 環境構築用のシェルスクリプトを実行する。

```bash
$ chmod u+x build_env.sh && ./build_env.sh
```

### DBデータの初期投入を実施する。

```bash
docker-compose exec laravel_php /bin/bash
cd project
php artisan migrate:fresh --seed
```

### フロントソースビルドの実施

```bash
npm run dev
```

### 各種サイトを確認する。

## サイトURL

### laravel

http://127.0.0.1:8080/article

→検索キーワードにピアノを入力し、GPTによる関連キーワード出力結果とDB入力データが出ること。

### adminer(DB管理ツール)

http://127.0.0.1:8081


* ログイン情報
  - サーバ: laravel_db
  - ユーザ名: laravel
  - パスワード: password
  - データベース: laravel

### mailhog(メールサーバ)

http://127.0.0.1:8025


## コンテナ起動する方法

`docker-compose.yml`が存在するフォルダーで以下のコマンドを実行する。

```bash
$ docker-compose up -d
```

## コンテナ停止する方法

`docker-compose.yml`が存在するフォルダーで以下のコマンドを実行する。

```bash
$ docker-compose stop
```

## コンテナ削除する方法

`docker-compose.yml`が存在するフォルダーで以下のコマンドを実行する。

```bash
$ docker-compose down
```

## 起動中のコンテナに入る

### PHPコンテナ

```bash
$ docker-compose exec laravel_php /bin/bash
```

### DBコンテナ

```bash
$ docker-compose exec laravel_db /bin/bash
```
