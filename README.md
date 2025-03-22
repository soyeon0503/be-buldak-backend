# be-buldak-backend

## 설명
불닭이되 백엔드 repository

[사용언어 & 프레임워크]
php8.0
Laravel 12.0

## 개발 기간
2025.03 ~ 

## DB
mysql 8.0

[테이블구조](https://docs.google.com/spreadsheets/d/1Qtq4swwGVBhHm2d_RhBszqBj8a78wK8EcrWIyQghiso/edit?usp=sharing)

DB변경사항이 있을 때 (단순 테이블 추가)
```
docker compose buldak-app php artisan migrate
```

DB변경사항이 있을 때 (더미 데이터 추가)
```
docker compose buldak-app php artisan migrate -seed
```

DB변경사항이 있을 때 (롤백)
```
docker compose buldak-app php artisan migrate:refresh -seed
```

## 환경구축

1. ``` git clone  https://github.com/soyeon0503/be-buldak-backend.git ``` 
2. ``` cd src ```
3. ``` cp .env .env.example ```
4. ``` cd ../ ```
5. ``` . ./init.sh ```
6. [swagger](http://localhost:8081) 접속 확인



## 화면설계서
추가예정


## FE 레포지토리
[FE]()
