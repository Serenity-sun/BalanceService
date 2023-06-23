all: run

run:
	cp env.example .env
	docker-compose up -d
	docker exec api_balance composer install
	docker exec api_balance chmod -R 777 runtime

migrate:
	docker exec api_balance php yii migrate/up --interactive=0

stop:
	docker-compose down
