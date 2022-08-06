<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::create([
            'title_long_introduction' => "ENSA Maroc",
            'long_description' => "On a l'honneur de vous présenter  pour la première fois le plus grand réseau qui joint tous les ENSA du Maroc, résumant toutes les sections et les niveaux de la première année classe préparatoire intégrée à la 5 ème année pour tout genre de filière. C'est une opportunité pour mieux connaitre le système Ensaiste, aussi que les activités parascolaires qui ont lieu dans chaque ENSA dans le but de faire des compétitions et rendre le monde de l'ENSA encore plus vaste et faire jaillir l'esprit d'ingénieur qui frissonne en chacun ! L'idée  du site aussi que sa création étant par Monsieur Jamal Taoussi  élève ingénieur à ENSA SAFI. Soyez les bienvenus, Ensaiste ou pas ! Ce site est accessible à tout le monde, en espérant  qu'il  vous rendra service ! En ce qui concerne les cours, leur lancement se terminera vers la fin de février, pour que le site soit une source d'information pour tout niveau et pour toutes les promotions d'avenir ! Encouragez-nous par un j'aime à la page Facebook et soyez les bienvenus encore une fois pour vos avis ! Profitez-en à fond !",
            'short_description' => "On a l'honneur de vous présenter  pour la première fois le plus grand réseau qui joint tous les ENSA du Maroc, résumant toutes les sections.",
            'email' => "ensamaroc11@gmail.com",
            'logo' => "/storage/uploads/logo/default.webp",
            'language' => "fr",
            'facebook_link' => "https://www.facebook.com/SiteEnsaMaroc",
            'instagram_link' => "#",
            'linkedin_link' => "#",
            'youtube_link' => "https://www.youtube.com/channel/UCogaXE9PHNpvY5GwErzL9OQ/featured",
        ]);
    }
}
