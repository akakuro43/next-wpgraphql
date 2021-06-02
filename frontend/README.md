### 前提条件

**Docker version 20.10.6**  
**docker-compose version 1.29.1**

### 各種バージョン

- Node: 16.0.0
- npm: 7.0.3
- PHP: 7.4.11 (cli)
- WordPress: 5.5.3
- MySQL: 5.7
- phpMyAdmin: 5

<br>
<br>

### 環境構築

```
$ docker-compose up --build -d

### パッケージのインストール

```
$ docker-compose exec node npm install
```

<br>
<br>

### Docker サービスを停止

```
$ docker-compose stop
```

<br>

### Docker サービスを停止と削除

```
$ docker-compose down
```

<br>

### Docker サービスを開始

```
$ docker-compose up -d
```

<br>

### Docker サービス関連全消し

```
$ docker-compose down --rmi all --volumes
```