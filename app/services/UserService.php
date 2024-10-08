<?php

class UserService extends Requests { 

  /* Listamos los usuarios */
  public function list() {

    $method = $this->getMethod();
    $user_model = new User();

    if ($method == 'GET') {
      $users_exists = $user_model->getUsers();
      if ($users_exists) { $this->success( $users_exists ); } //Obtenemos exitosamente resultados
      else { $this->failed(401, "Aun no hay usuarios."); }
    } else { 
      $this->failed(405,"HTTP Method not allowed"); 
    }

  }

  /* Listamos un usuario en especifico */
  public function listById($id) {

    $method = $this->getMethod();
    $user_model = new User();

    if ($method == 'GET') {
      $user_exists = $user_model->getUsersBy($id[0]);
      if ($user_exists) { $this->success( $user_exists ); } //Obtenemos exitosamente resultados
      else { $this->failed(401, "No se encontro usuario."); }
    } else {
      $this->failed(405,"HTTP Method not allowed"); 
    }

  }

  /* Creamos un usuario nuevo */
  public function create() {
    $method = $this->getMethod();
    $body = $this->parseBodyInput();
    $user_model = new User();

    if ($method === 'POST') {
      //Validamos los datos no esten vacios
      if (!empty($body['name']) && !empty($body['email']) && !empty($body['phone'])) {
        $name = $body['name'];
        $email = $body['email'];
        $phone = $body['phone'];
        //Validamos el formato del email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          //Validamos la existencia del usuario
          if ( !$user_model->emailAlreadyExists($email) ) {

            $create_user = $user_model->createUser([$name, $email, $phone]);
            if ($create_user) { $this->success( $create_user, "Usuario creado exitosamente." ); } //Creacion exitosa
            else { $this->failed(401, "Ups! Algo sucedio, vuelva intentarlo."); }

          } else {
            $this->failed(406,"Este email ya se encuentra registrado."); 
          }
        } else {
          $this->failed(406,"Por favor, ingrese un email valido."); 
        }
      } else {
        $this->failed(406,"Algunos campos estan vacios."); 
      }
    } else {
      $this->failed(405,"HTTP Method not allowed"); 
    }
  }

  /* Actualizamos un usuario en especifico */
  public function update() {
    $method = $this->getMethod();
    $body = $this->parseBodyInput();
    $user_model = new User();

    if ($method == 'PUT') {
      //Validamos los datos no esten vacios
      if (!empty($body['id']) && !empty($body['name']) && !empty($body['phone']) && !empty($body['status'])) {
        $name = $body['name'];
        $phone = $body['phone'];
        $status = $body['status'];
        $user_id = $body['id'];

        $update_user = $user_model->updateUser([$name, $phone, $status, $user_id]);
        if ($update_user) { $this->success( $update_user, "Usuario actualizado exitosamente." ); } //Actualizacion exitosa
        else { $this->failed(401, "Ups! Algo sucedio, vuelva intentarlo."); }

      } else {
        $this->failed(406,"Algunos campos estan vacios.");
      }
    } else {
      $this->failed(405,"HTTP Method not allowed"); 
    }

  }

  /*Eliminamos un usuario en especifico */
  public function remove($id) {
    $method = $this->getMethod();
    $user_model = new User(); 

    if ($method == 'DELETE') { 
      
        $delete_user = $user_model->removeUser($id[0]);
        if ($delete_user) { $this->success( $delete_user, "Usuario actualizado exitosamente." ); } //Borrado exitoso
        else { $this->failed(406, "Ups! Algo sucedio, vuelva intentarlo."); }
      
    } else {
      $this->failed(405,"HTTP Method not allowed"); 
    }

    
  }

}