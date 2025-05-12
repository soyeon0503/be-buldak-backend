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
docker compose buldak-app php artisan migrate:refresh --seed
```

## 환경구축

1. ``` git clone  https://github.com/soyeon0503/be-buldak-backend.git ``` 
2. ``` cd src ```
3. ``` cp .env.example .env```
4. ``` cd ../ ```
5. ``` . ./init.sh ```
6. [swagger](http://localhost:8081) 접속 확인



## 화면설계서
[figma](https://www.figma.com/design/toY46LpbgZxdI5nKEpmIr3/%EB%B6%88%EB%8B%AD%EC%9D%B4%EB%90%98?node-id=0-1&p=f&t=5EV5GZJx2wbW3wJb-0)


## FE 레포지토리
[FE]()
