<?php 

include_once("../db/DbConnection.php");
include_once("../Models/Contacts.php");

class ContactsService {

  private $db;

  public function __construct()
  {
    $this->db = new DbConnection();
  }

  public function getContacts($id = null)
  {
    $contacts = array();

    if($id != null){
      $query = "SELECT * FROM contacts WHERE id = $id";
    } else {
      $query = "SELECT * FROM contacts";
    }
    
    $result = $this->db->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
      $contacts[] = new Contacts($row);
    }

    if (empty($contacts)) {
      return [
        "status" => 404,
        "message" => "No existen contactos o eligio un id incorrecto"];
    }

    return $contacts;
    
  }


  public function createContact(Contacts $contact)
  {

    if($contact->extraPhone == null){
      $query = "INSERT INTO contacts (firstName, lastName, email, phone) VALUES ('$contact->firstName', '$contact->lastName', '$contact->email', '$contact->phone')";
    }
    else{
      $query = "INSERT INTO contacts (firstName, lastName, email, phone, extraPhone) VALUES ('$contact->firstName', '$contact->lastName', '$contact->email', '$contact->phone', '$contact->extraPhone')";
    }
    $result = $this->db->connect()->query($query);
    if($result){
      return [
        "status" => 201,
        "message" => "El contacto  ha sido creado correctamente"];
    } else {
      return [
        "status" => 500,
        "message" => "Error al crear el contacto"];
    }    
  }

  public function updateContact($contact)
  {
    $itExists = $this->getContacts($contact->id);
    if(!$itExists instanceof Contacts){
      return [
        "status" => 404,
        "message" => "El contacto no existe"];
    }


      $query = "UPDATE contacts SET firstName = '$contact->firstName', lastName = '$contact->lastName', email = '$contact->email', phone = '$contact->phone', extraPhone = '$contact->extraPhone' WHERE id = $contact->id";
      $result = $this->db->connect()->query($query);
      if($result){
        return [
          "status" => 200,
          "message" => "El contacto  ha sido actualizado correctamente"];
      } else {
        return [
          "status" => 500,
          "message" => "Error al actualizar el contacto"];
      } 
  }

  public function deleteContact($id)
  {
    $itExists = $this->getContacts($id);
    if(!$itExists instanceof Contacts){
      return [
        "status" => 404,
        "message" => "El contacto no existe"];
    }

    $query = "DELETE FROM contacts WHERE id = $id";
    $result = $this->db->connect()->query($query);
    if($result){
      return [
        "status" => 200,
        "message" => "El contacto  ha sido eliminado correctamente"];
    } else {
      return [
        "status" => 500,
        "message" => "Error al eliminar el contacto"];
    }
  }

}

?>