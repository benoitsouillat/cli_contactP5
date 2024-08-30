<?php
require __DIR__ . '/classes/Command.php';

$detailPattern = '/^[Dd]etail\s*([0-9]+)$/'; // Les parenthèses servent à stocker la valeur dans une des entrées du tableau $matches
$createPattern = '/^[Cc]reate\s*([A-Za-z]+),\s*([A-Za-z0-9]+@[A-Za-z0-9]+\.[a-z]{2,}+),\s*(0[0-9]{9})$/';
$modifyPattern = '/^[Mm]odify\s*([0-9]+)\s*([A-Za-z]+),\s*([A-Za-z0-9]+@[A-Za-z0-9]+\.[a-z]{2,}+),\s*(0[0-9]{9})$/';
$deletePattern = '/^[Dd]elete\s*([0-9]+)$/';

while (true) {
    $line = readline("Entrez votre commande : ");
    $command = new Command();
    if ($line === 'list') {
        $command->list();
    } elseif (preg_match($detailPattern, $line, $matches)) {
        $id = $matches[1];
        $command->detail($id);
    } elseif (preg_match($createPattern, $line, $matches)) {
        $name = ucfirst($matches[1]);
        $email = $matches[2];
        $phone = $matches[3];
        $infos = [$name, $email, $phone];
        $command->create($infos);
    } elseif (preg_match($modifyPattern, $line, $matches)) {
        $id = $matches[1];
        $name = ucfirst($matches[2]);
        $email = $matches[3];
        $phone = $matches[4];
        $infos = [$id, $name, $email, $phone];
        $command->modify($infos);
    } elseif (preg_match($deletePattern, $line, $matches)) {
        $id = $matches[1];
        $command->delete($id);
    } elseif ($line === 'help') {
        $command->help();
    } elseif ($line === 'quit' || $line === 'exit') {
        $command->quit();
    } else {
        echo "Vous avez saisi : $line\n";
    }
}
