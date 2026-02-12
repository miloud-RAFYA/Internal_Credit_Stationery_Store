<?php

namespace App\Notifications;

use App\Models\Commande; // Importation du modèle
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NouvelleCommandePremium extends Notification
{
    use Queueable;

    protected $commande; // Déclaration de la propriété

    /**
     * On injecte l'objet Commande ici
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Données qui seront stockées en JSON dans la table 'notifications'
     */
    public function toArray(object $notifiable): array
    {
        return [
            'commande_id' => $this->commande->id,
            'employe_name' => $this->commande->user->employe->nom ?? $this->commande->user->nom,
            'employe_id' => $this->commande->user->id,
            'montant' => $this->commande->montant_tokens,
            'message' => 'Une nouvelle commande premium attend votre validation.'
        ];
    }
}