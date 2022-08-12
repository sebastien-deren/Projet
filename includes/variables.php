<?php
/*ajout des variables nécessaires au bon fonctionnement du site,
    la majorité de ces variables seront remplacé par des appels à la BDD*/
    $users = [
        ['nom' => 'jean',
        'prenom' => 'valjean',
        'mail' => 'jean.valjean@text.p',
        'mdp' => '1234',
        ],
        ['nom' => 'poulet',
        'prenom'=> 'cotcot',
        'mail'=>'poulet.cotcot@terxt.d',
        'mdp'=>'1234',
        ],
        ['nom' => 'renard',
        'prenom' => 'goupil',
        'mail' => 'goupil@renard.c',
        'mdp' => '456',
        ],

        
        ];
        $products =[[
            'name' => 'beurre',
            'quantity' => '25',
            'unit_quantity' =>'250g',
            'price' => '1.5',
        ],
        [
            'name' =>'lait',
            'quantity' => '100',
            'unit_quantity'=> 'L',
            'price' => '0.89',
        ],
        [
            'name' => 'emmental',
            'quantity' => '25',
            'unit_quantity'=>'Kg',
            'price' => '15'
        ],
        [
            'name' => 'reblochon',
            'quantity' => '30',
            'unit_quantity' => 'piece',
            'price' => '7', 
        ],

    ];
    ?>