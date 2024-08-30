<?php
require(__DIR__ . '/DBConnect.php');
require(__DIR__ . '/Contact.php');

class ContactManager
{
    private PDO $pdo;
    private array $list;
    public function __construct()
    {
        $this->pdo = DBConnect::getPDO();
        $this->list = [];
    }
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contact');
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datas as $data) {
            $contact = new Contact($data['id'], $data['name'], $data['email'], $data['phone_number']);
            array_push($this->list, $contact);
        }
        return $this->list;
    }
    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contact WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $contact = new Contact($data['id'], $data['name'], $data['email'], $data['phone_number']);
        return $contact;
    }

    public function create($name, $email, $phone)
    {
        $stmt = $this->pdo->prepare('INSERT INTO contact (`name`, `email`, `phone_number`) VALUES (:name, :email, :phone_number)');
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone_number', $phone);
        try {
            $stmt->execute();
            echo 'Le contact ' . $name . ' a bien été créé. ' . PHP_EOL;
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e;
        }
    }
    public function modify($id, $name, $email, $phone)
    {
        $stmt = $this->pdo->prepare('UPDATE contact SET `name` = :name, `email` = :email, `phone_number` = :phone_number WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone_number', $phone);
        try {
            $stmt->execute();
            echo 'Les informations de ' . $name . ' ont étaient modifiées. ' . PHP_EOL;
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e;
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->find($id);
            $stmt = $this->pdo->prepare('DELETE FROM contact WHERE `id` = :id');
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            echo 'Suppression du contact ' . $data->getName() . ' ...' . PHP_EOL;
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e;
        }
    }
}
