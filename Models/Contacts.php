<?php 

class Contacts {
  public ?int $id;
  public string $firstName;
  public string $lastName;
  public string $email;
  public string $phone;
  public ?string $extraPhone;


  public function __construct(array $data = null) {
    if (is_array($data)) {
      if (isset($data['id'])) $this->id = $data['id'];
      $this->firstName = $data['firstName'];
      $this->lastName = $data['lastName'];
      $this->email = $data['email'];
      $this->phone = $data['phone'];
      if (isset($data['extraPhone'])){
        $this->extraPhone = $data['extraPhone'];
      } else {
        $this->extraPhone = null;
      }
    }
  }


}


?>