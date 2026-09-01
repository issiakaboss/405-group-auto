<?php

return [
    'title' => 'Gestion des Commandes',
    'subtitle' => 'Validez, mettez à jour ou annulez les commandes clients.',
    'order_details' => 'Détails de la commande #:id',
    'back_to_list' => 'Retour à la liste des commandes',
    'columns' => [
        'id_date' => 'ID / Date',
        'customer' => 'Client',
        'contact' => 'Contact',
        'total_amount' => 'Montant Total',
        'current_status' => 'Statut Actuel',
        'action' => 'Action',
    ],
    'sections' => [
        'ordered_items' => 'Articles commandés',
        'customer_info' => 'Informations client',
        'update_status' => 'Mettre à jour le statut',
    ],
    'fields' => [
        'quantity' => 'Qté : :qty',
        'total_amount' => 'Montant total',
        'name' => 'Nom',
        'email' => 'E-mail',
        'phone' => 'Téléphone',
        'address' => 'Adresse',
    ],
    'statuses' => [
        'pending_review' => 'En revue',
        'confirmed' => 'Confirmée',
        'shipping' => 'En Transit / Shipping',
        'delivered' => 'Livrée',
        'cancelled' => 'Annulée',
    ],
    'buttons' => [
        'update_order' => 'Mettre à jour la commande',
    ],
    'empty' => 'Aucune commande enregistrée pour le moment.',
];