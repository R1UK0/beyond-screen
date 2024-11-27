// Exemple d'envoi d'e-mail à 100, 200, etc. visiteurs
$threshold = 100;  // Le seuil d'alerte
if ($total_visits % $threshold === 0) {
    mail("ryuko.dvp@gmail.com", "Threshold Reached", "We have reached $total_visits visitors today!");
}
