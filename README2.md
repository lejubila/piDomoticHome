Install redis e npm  
sudo apt install redis-server npm

Installare laravel-echo-server  
sudo npm install -g laravel-echo-server

Inizializzazione laravel-echo-server nella directory del progetto  
cd ~/piDomotocHome  
laravel-echo-server init  
? Do you want to run this server in development mode? Yes  
? Which port would you like to serve from? 6001  
? Which database would you like to use to store presence channel members? redis  
? Enter the host of your Laravel authentication server. http://localhost  
? Will you be serving on http or https? http  
? Do you want to generate a client ID/Key for HTTP API? Yes  
? Do you want to setup cross domain access to the API? No  
appId: 21791b40b10f3c18  
key: 495b397e237700a3289e70e0f59b12b2  
Configuration file saved. Run laravel-echo-server start to run server.  

Avviare laravel-echo-sever  
laravel-echo-server start  
