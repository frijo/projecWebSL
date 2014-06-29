Sample RabbitMQ Class
=========================== 
By. Misael Matamoros, basado en la documentación oficial de RabbitMQ

## Pre-requisitos
Para ejecutar esta aplicación se requiere tener instalado los siguientes paquetes:

 - RabbitMQ
 - PHP5
 - Composer

### Instalar RabbitMQ en GNU/Linux Debian
	
	$ sudo apt-get install rabbitmq-server
	
### Instalar RabbitMQ en OpenSuse
	
	$ sudo zypper install rabbitmq-server rabbitmq-server-plugins

## Demo

Esta aplicación de demostración consta de un único archivo `[ rabbit_mq_demo.php ]`, donde se define una clase que contiene la lógica de encolado y recuperación de mensajes.

### Instalar "videlalvaro/php-amqplib"
Para utilizar RabbitMQ con PHP, se requiere del paquete `[ php-amqplib ]`, para instalarlo con el gestor de dependecias composer, ejecute el siguiete comando:

	estudiante@lab301:~/php_sample_rabbitmq$ composer install


### Para ejecutar el demo

	estudiante@lab301:~/php_sample_rabbitmq$ php rabbit_mq_demo.php