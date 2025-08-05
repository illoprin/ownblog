# illoprin.ru - portfolio blog

## How to start

### 0. Clone repository

```bash
git clone https://github.com/illoprin/ownblog.git
cd ownblog
```

### 1. Install Composer dependencies

> ⚠️ Make sure Composer is installed.

```bash
cd ./theme/illoprinblog
composer install
```

### 2. Run docker images

```bash
docker compose up -d --build
```

Site is available at [localhost](http://localhost)