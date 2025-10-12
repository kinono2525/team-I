## 1. 前提条件
- Docker / Docker Compose がインストール済み
- PHP / Composer がローカルにあると便利（Sailでラッパーとして使用）
- Node.js / npm が必要な場合はインストール

---

## 2. リポジトリをクローン
git clone https://github.com/kinono2525/team-I.git
cd "プロジェクトのパス名"

---

## 3. 依存関係のインストール
composer install

---

## 4. Laravel アプリキーの生成
./vendor/bin/sail artisan key:generate

---

## 5. Docker コンテナの起動
./vendor/bin/sail up -d

---

## 6. 動作確認
- Laravel アプリ：ブラウザで http://localhost
- phpMyAdmin：ブラウザで http://localhost:8080