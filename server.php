<?php

      header('Content-Type: text/plain;');
      set_time_limit(0);
      ob_implicit_flush();      
   echo "-= Server =-\n\n";
     
$NULL           = NULL;
$adres          = "localhost";
$port           = 1024;
$max_clients    = 3;
$sockets_clients = array();
$creat         = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$rez            = true;

   echo 'Create socket ... ';
    if(!$creat){     die("socket_create() failed\n") ;    }
    else{      echo "OK\n";    }
     
   $rez &= @socket_bind($creat, $adres, $port);
   echo 'Bind socket ... ';
    if(!$rez){      die("socket_bind() failed\n") ;    }
    else{      echo "OK\n";    }

 $rez &= @socket_listen($creat);
   echo 'Listen socket ... ';
    if(!$rez){      die("socket_listen() failed\n") ;    }
    else{      echo "OK\n";    }
    
   echo "Accepting of socket ... OK\n";
$abort = false;
$read = array($creat);
     
while(!$abort)
    {
      $num_changed = socket_select($read, $NULL, $NULL, 0, 10);
      /* Изменилось что-нибудь? */
      if ($num_changed)
      {
          /* Изменился ли главный сокет (новое подключение) */
          if(in_array($creat, $read))
          {
                  if(count($sockets_clients) < $max_clients)
                 {
                          $sockets_clients[]= socket_accept($creat);
                          echo " Accept socket (" . count($sockets_clients)  . " of $max_clients clients)\n";
                          // socket_write($sockets_clients[count($sockets_clients)-1], "Hello, Client!", 15);
                          echo "  Say to ".count($sockets_clients)." client: Hello, Client!\n";
                  }
          }        
          /* Цикл по всем клиентам с проверкой изменений в каждом из них */
          foreach($sockets_clients as $key => $client)
         {

              /* Новые данные в клиентском сокете? Прочитать и ответить */
              if(in_array($client, $read)){
                  $input = socket_read($client, 1024);
                    
                  /*Блок отправления данных клиентам*/
                  for ($i=0; $i<>count($sockets_clients); $i++){
                    if($sockets_clients[$i]!=$client){
                      socket_write($sockets_clients[$i],"$input") ;
                    }
                  }
                    /*close socket, if message = bye*/                     
                  if($input == 'bye')
                   {
                      echo "Close socket ... OK\n";
                      socket_close($creat);
                      $abort = true;
                  }               
             
              }// END IF in_array            
           
          } // END FOREACH
         
      } // END IF ($num_changed)
        
                      
      $read = $sockets_clients;
      $read[] = $creat;
} // END WHILE 
   ?>              