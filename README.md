## 1. 前提条件
- Docker / Docker Compose がインストール済み
- Node.js / npm が必要な場合はインストール

---

## 2. .env を作成
cp .env.example .env

---

## 3. リポジトリをクローン
git clone https://github.com/kinono2525/team-I.git
cd "プロジェクトのパス名"

---

## 4. 依存関係のインストール
composer install

---

## 5. Docker コンテナの起動
./vendor/bin/sail up -d

---

## 6. Laravel アプリキーの生成
./vendor/bin/sail artisan key:generate

---

## 7. マイグレートの実行
./vendor/bin/sail artisan migrate

---

## 8. 動作確認
- Laravel アプリ：ブラウザで http://localhost
- phpMyAdmin：ブラウザで http://localhost:8080