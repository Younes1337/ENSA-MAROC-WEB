<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    protected $faqs = [
        [
            'question' => 'C\'est quoi ENSA ?',
            'response' => 'Ecole Nationale des sciences appliquées, c\'est un groupe de 12 écoles dans la plupart de villes marocaines, une école d\'ingénierie publique.'
        ],
        [
            'question' => 'Combien d\'année à ENSA ?',
            'response' => 'L\'ENSA contient 5 ans d\'études, 2 ans classes préparatoires intégrées et 3 ans spécialité du cycle d\'ingénieur.'
        ],
        [
            'question' => 'Comment l\'accès à l\'ENSA ?',
            'response' => 'L\'admission au cycle préparatoire ENSA Maroc est ouverte, sur concours et dans la limite des places disponibles, aux candidats titulaires du baccalauréat de l\'enseignement secondaire obtenu dans les domaines scientifique ou technique ou d\'un diplôme reconnu équivalent.
            Etape 1 : ENSA Maroc annonce un seuil pour chaque filière (PC-SVT / SC.maths), 75% National 25% régionale.
            Après avoir été sélectionné par seuil, vous passerez à la deuxième étape.
            Etape 2 : Passer un concours Maths, physique, chimie.'
        ],
        [
            'question' => 'Est-ce qu\'on est affecté juste à l\'ENSA de notre ville ?',
            'response' => 'Non, vous avez la possibilité d\'étudier dans n\'importe ville, selon le choix que vous avez déposé sur la plateforme mais vous pouvez ne pas avoir votre premier choix, mais il y a possibilité de demander un transfert, ceci diffère d\'un cas à un autre.'
        ],
        [
            'question' => 'On peut accéder à l\'ENSA avec un bac économie ?',
            'response' => 'Non, l\'ENSA accepte juste le bac scientifique, technique, ou un diplôme équivalent.'
        ],
        [
            'question' => 'Quelles sont les cours qui sont posés dans le concours ?',
            'response' => 'Les cours étudiés au bac, il faut bien sûr une préparation.'
        ],
        [
            'question' => 'Le concours est-il en français ?',
            'response' => 'Oui, le concours est 100% en français.'
        ],
        [
            'question' => 'Est-ce que les études en cycle préparatoire sont difficiles ? parce que ma fille trouve des difficultés ?',
            'response' => 'Comme toute classe préparatoire, la difficulté existe mais ceci diffère d\'un candidat à un autre, il faut juste booster le travail et la préparation et être concentré durant ses cours et bien sûr rester actif et poser des questions.'
        ],
        [
            'question' => 'Comment accéder après 2 ans ?',
            'response' => 'L\'accès au concours d\'admission en première année du cycle ingénieur est ouvert aux titulaires d\'un diplôme Bac + 2 (DUT, DEUG, DEUST, DEUP…) ou équivalent, avec condition d\'atteindre un seuil qui soit déclaré par chaque ENSA au Maroc.'
        ],
        [
            'question' => 'On peut accéder à u ENSA avec Bac éco ?',
            'response' => 'Non, malheureusement, ENSA accepte un bac scientifique ou technique.'
        ],
        [
            'question' => 'Quels sont les modules étudiés à la première année ?',
            'response' => 'Algèbre, Analyse, Electrostatique, magnétostatique, algorithme, Mécanique de point, Français , Anglais...'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->faqs as $faq) { FAQ::create($faq); }
    }
}
