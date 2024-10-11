Juego de Toros y Bacas
**********************
Toros y vacas es un juego tradicional inglés a lápiz y papel para dos jugadores cuyo objetivo es adivinar un número constituido por cuatro dígitos. 
En una hoja de papel, un jugador escribe un número de 4 dígitos y lo mantiene en secreto. Las cifras deben ser todas diferentes, no se debe repetir ninguna dentro del mismo número. El otro jugador trata de adivinar el número secreto en varios intentos que son anotados y numerados. 
En cada intento anota una cifra de cuatro dígitos completa, ésta es evaluada por el jugador que guarda el número secreto. Si una cifra está presente y se encuentra en el lugar correcto es evaluada como un toro, si una cifra está presente pero se encuentra en un lugar equivocado es evaluada como una vaca. La evaluación se anota al lado del intento y es pública.  
Al adivinarse el número termina la partida. 


1- Instalar en la PC de desplique:
   Composer para las dependencias.
   Laragon o Wampserver como entorno de desarrollo.

2- Instalar librerias de dependencias con el comando "nmp install"(Tener instalado Node.js para correr dicho comando).

3- Base datos: 
  Crear fichero (nombre de la BD) en directorio /database/toros_vacas.sqlite
  Correr las migraciones y los seeder para generar la BD con el comando "php artisan migrate:refresh --seed".

4- Sistema web: Para entrar al sistema 
   usuario: admin@bullscows.cu
   contraseña: password
