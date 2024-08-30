<?php

require(__DIR__ . '/ContactManager.php');

class Command
{
    private $manager;
    public function __construct()
    {
        $this->manager = new ContactManager();
    }
    public function list(): void
    {
        echo 'Affichage de la liste : ' . PHP_EOL;
        $datas = $this->manager->findAll();
        foreach ($datas as $data) {
            echo $data->__toString();
        }
    }
    public function detail($id): void
    {
        echo 'Affichage des informations du contact : N°' . $id . PHP_EOL;
        $data = $this->manager->find($id);
        echo $data->__toString();
    }
    public function create(array $infos): void
    {
        $this->manager->create(...$infos);
    }
    public function modify(array $infos)
    {
        $this->manager->modify(...$infos);
    }
    public function delete(int $id): void
    {
        $this->manager->delete($id);
    }
    public function quit(): void
    {
        exit();
        die();
    }
    public function help(): void
    {
        echo sprintf("Voici la liste des commandes disponibles :  %s 
        list : Affiche la liste de tous les contacts enregistrés.  %s 
        create [nom], [adresse email], [numéro de téléphone] : Enregistre un nouveau contact  %s 
        modify [identifiant] [nom], [adresse email], [numéro de téléphone] : Modifie le contact spécifié  %s 
        detail [identifiant] : Donne les informations d'un contact spécifique  %s 
        delete [identifiant] : Supprime un contact existant - Attention ! Cette action est irreversible ! %s
        quit : Quitter le programme %s", PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL);
    }
}
