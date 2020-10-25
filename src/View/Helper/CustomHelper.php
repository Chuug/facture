<?php
	namespace App\View\Helper;

	use Cake\View\Helper;
	use Cake\ORM\TableRegistry;

	class CustomHelper extends Helper
	{
		public function getCompagnies()
		{
			$CompagniesTable = TableRegistry::get('Compagnies');
			$compagnies = $CompagniesTable->find('all')->select(['id','nom_societe']);
			$i = 0;
			$arrayCompany = '';
			foreach($compagnies as $company)
			{
				$arrayCompany[$company['id']] = $company['nom_societe'];
				$i++;
			}
			return $arrayCompany;
		}

		public function deviseFormat($n,$devise)
		{
			return $rep = $devise.' '.number_format($n,2,',',' ');
		}

		public function getDevisState($n)
		{
			switch ($n) {
				case 1:
					$state = 'Provisoire';
					break;
				case 2:
					$state = '<span class="text-info">Finalisé</span>';
					break;
				case 3:
					$state = '<span class="text-danger">Refusé</span>';
					break;
				case 4:
					$state = '<span class="text-success">Signé</span>';
					break;
				case 5:
					$state = '<span class="text-info">Payée</span>';
					break;
			}
			return $state;
		}

		public function getFormatedType($type)
		{
			switch ($type) 
			{
				case 'devis':
					$formated = 'Devis';
					break;
				case 'factures':
					$formated = 'Facture';
					break;
				case 'avoirs':
					$formated = 'Avoir';
					break;
				case 'acomptes':
					$formated = "Facture d'acompte";
					break;
			}
			return $formated;			
		}

		public function getLanguages()
		{
			return $tab = [
				'Français' => 'Français',
				'Anglais' => 'Anglais',
				'Néerlandais' => 'Néerlandais'
			];
		}

		public function getArticleType()
		{
			return $tab = [
				'Acompte' => 'Acompte',
				'Heures' => 'Heures',
				'Jours' => 'Jours',
				'Produit' => 'Produit',
				'Service' => 'Service'
			];
		}

		public function getPayConditions()
		{
			return $tab = [
				'Voir détail ci après' => 'Voir détail ci après',
				'Sur réception' => 'Sur réception',
				'Fin de mois' => 'Fin de mois',
				'10 jours' => '10 jours',
				'30 jours' => '30 jours',
				'30 jours fin de mois' => '30 jours fin de mois',
				'45 jours fin de mois' => '45 jours fin de mois',
				'60 jours' => '60 jours',
				'60 jours fin de mois' => '60 jours fin de mois',
				'90 jours' => '90 jours',
				'90 jours fin de mois' => '90 jours fin de mois',
				'120 jours' => '120 jours'
			];
		}

		public function getPayTypes()
		{
			return $tab = [
				'Non spécifié' => 'Non spécifié',
				'Espèces' => 'Espèces',
				'Chèque' => 'Chèque',
				'Virement bancaire' => 'Virement bancaire',
				'Carte bancaire' => 'Carte bancaire',
				'PayPal' => 'PayPal',
				'Prélèvement' => 'Prélèvement',
				'Lettre de change' => 'Lettre de change',
				'Lettre de change relevé' => 'Lettre de change relevé',
				'Lettre de change sans acceptation' => 'Lettre de change sans acceptation',
				'Billet à ordre' => 'Billet à ordre'
			];
		}

		public function getPayInterests()
		{
			return $tab = [
				"Pas d'intérêts de retard" => "Pas d'intérêts de retard",
				'1% par mois' => '1% par mois',
				'1,5% par mois' => '1,5% par mois',
				'2% par mois' => '2% par mois',
				"Taux d'intérêt légal en vigueur" => "Taux d'intérêt légal en vigueur"
			];
		}

		public function getDevises()
		{
			return $tab = [
				0 => 'Euro'
			];
		}

		public function getCountries()
		{
			return $tab = [
				"Afghanistan" => "Afghanistan",
				"Afrique du sud" => "Afrique du sud",
				"Albanie" => "Albanie",
				"Algérie" => "Algérie",
				"Allemagne" => "Allemagne",
				"Andorre" => "Andorre",
				"Angola" => "Angola",
				"Anguilla" => "Anguilla",
				"Antarctique" => "Antarctique",
				"Antigua et Barbuda" => "Antigua et Barbuda",
				"Arabie Saoudite" => "Arabie Saoudite",
				"Argentine" => "Argentine",
				"Arménie" => "Arménie",
				"Aruba" => "Aruba",
				"Australie" => "Australie",
				"Autriche" => "Autriche",
				"Azerbaïdjan" => "Azerbaïdjan",
				"Bahamas" => "Bahamas",
				"Bahreïn" => "Bahreïn",
				"Bangladesh" => "Bangladesh",
				"Barbade" => "Barbade",
				"Belgique" => "Belgique",
				"Bélize" => "Bélize",
				"Bénin" => "Bénin",
				"Bhoutan" => "Bhoutan",
				"Biélorussie" => "Biélorussie",
				"Bolivie" =>"Bolivie",
				"Bosnie-Herzégovine" => "Bosnie-Herzégovine",
				"Botswana" => "Botswana",
				"Brésil" => "Brésil",
				"Brunéi" => "Brunéi",
				"Bulgarie" => "Bulgarie",
				"Burkina Faso" => "Burkina Faso",
				"Burundi" => "Burundi",
				"Cambodge" => "Cambodge",
				"Cameroun" => "Cameroun",
				"Canada" => "Canada",
				"Canal de Panama" => "Canal de Panama",
				"Cap Vert" => "Cap Vert",
				"Centre-Afrique" => "Centre-Afrique",
				"Chili" => "Chili",
				"Chine" => "Chine",
				"Chine" => "Chine",
				"Chypre" => "Chypre",
				"Colombie" => "Colombie",
				"Comoros" => "Comoros",
				"Congo" => "Congo",
				"Corée du Nord" => "Corée du Nord",
				"Corée du Sud" => "Corée du Sud",
				"Costa Rica" => "Costa Rica",
				"Côte d'Ivoire" => "Côte d'Ivoire",
				"Croatie" => "Croatie",
				"Cuba" => "Cuba",
				"Danemark" => "Danemark",
				"Djibouti" => "Djibouti",
				"Dominique" => "Dominique",
				"Egypte" => "Egypte",
				"El Salvador" => "El Salvador",
				"Emirats arabes unis" => "Emirats arabes unis",
				"Equateur" => "Equateur",
				"Erythrée" => "Erythrée",
				"Espagne" => "Espagne",
				"Estonie" => "Estonie",
				"Etats fédérés de Micronésie" => "Etats fédérés de Micronésie",
				"Etats-Unis" => "Etats-Unis",
				"Ethiopie" => "Ethiopie",
				"Fidji" => "Fidji",
				"Finlande" => "Finlande",
				"France" => "France",
				"Gabon" => "Gabon",
				"Gambie" => "Gambie",
				"Georgie" => "Georgie",
				"Ghana" => "Ghana",
				"Gibraltar" => "Gibraltar",
				"Grèce" => "Grèce",
				"Grenade" => "Grenade",
				"Groenland" => "Groenland",
				"Guadeloupe" => "Guadeloupe",
				"Guam" => "Guam",
				"Guatémala" => "Guatémala",
				"Guinée Bissau" => "Guinée Bissau",
				"Guinée Equatoriale" => "Guinée Equatoriale",
				"Guinée" => "Guinée",
				"Guyana" => "Guyana",
				"Guyane Française" => "Guyane Française",
				"Haïti" => "Haïti",
				"Honduras" => "Honduras",
				"Hongrie" => "Hongrie",
				"Iles Bermudes" => "Iles Bermudes",
				"Iles Cayman" => "Iles Cayman",
				"Iles Cook" => "Iles Cook",
				"Iles des Açores" => "Iles des Açores",
				"Iles Falkland" => "Iles Falkland",
				"Iles Mariannes du Nord" => "Iles Mariannes du Nord",
				"Iles Marshall" => "Iles Marshall",
				"Iles Palau" => "Iles Palau",
				"Iles Salomon" => "Iles Salomon",
				"Iles Vierges Américaines" => "Iles Vierges Américaines",
				"Iles Vierges Britanniques" => "Iles Vierges Britanniques",
				"Inde" => "Inde",
				"Indonésie" => "Indonésie",
				"Irak" => "Irak",
				"Iran" => "Iran",
				"Irlande" => "Irlande",
				"Islande" => "Islande",
				"Israël" => "Israël",
				"Italie" => "Italie",
				"Jamaïque" => "Jamaïque",
				"Japon" => "Japon",
				"Jordanie" => "Jordanie",
				"Kazakhstan" => "Kazakhstan",
				"Kénya" => "Kénya",
				"Kirghizstan" => "Kirghizstan",
				"Kiribati" => "Kiribati",
				"Koweït" => "Koweït",
				"Laos" => "Laos",
				"Lésotho" => "Lésotho",
				"Lettonie" => "Lettonie",
				"Liban" => "Liban",
				"Libéria" => "Libéria",
				"Libye" => "Libye",
				"Liechtenstein" => "Liechtenstein",
				"Lituanie" => "Lituanie",
				"Luxembourg" => "Luxembourg",
				"Macédoine" => "Macédoine",
				"Madagascar" => "Madagascar",
				"Malaisie" => "Malaisie",
				"Malawi" => "Malawi",
				"Maldives" => "Maldives",
				"Mali" => "Mali",
				"Malte" => "Malte",
				"Maroc" => "Maroc",
				"Martinique" => "Martinique",
				"Maurice" => "Maurice",
				"Mauritanie" => "Mauritanie",
				"Mexique" => "Mexique",
				"Moldavie" => "Moldavie",
				"Monaco" => "Monaco",
				"Mongolie" => "Mongolie",
				"Mozambique" => "Mozambique",
				"Myanmar" => "Myanmar",
				"Namibie" => "Namibie",
				"Nauru" => "Nauru",
				"Népal" =>"Népal",
				"Nicaragua" => "Nicaragua",
				"Niger" => "Niger",
				"Nigéria" => "Nigéria",
				"Niue" => "Niue",
				"Norvège" => "Norvège",
				"Nouvelle Calédonie" => "Nouvelle Calédonie",
				"Nouvelle Zélande" => "Nouvelle Zélande",
				"Oman" => "Oman",
				"Ouganda" => "Ouganda",
				"Ouzbékistan" => "Ouzbékistan",
				"Pakistan" => "Pakistan",
				"Panama" => "Panama",
				"Papouasie-Nouvelle-Guinée" => "Papouasie-Nouvelle-Guinée",
				"Paraguay" => "Paraguay",
				"Pays-Bas" => "Pays-Bas",
				"Pérou" => "Pérou",
				"Philippines" => "Philippines",
				"Pologne" => "Pologne",
				"Polynésie Française" => "Polynésie Française",
				"Porto Rico" => "Porto Rico",
				"Portugal" => "Portugal",
				"Qatar" => "Qatar",
				"République démocratique du Congo" => "République démocratique du Congo",
				"République Dominicaine" => "République Dominicaine",
				"République Tchèque" => "République Tchèque",
				"Réunion" => "Réunion",
				"Roumanie" => "Roumanie",
				"Royaume-Uni" => "Royaume-Uni",
				"Russie" => "Russie",
				"Rwanda" => "Rwanda",
				"Sahara Occidental" => "Sahara Occidental",
				"Saint Kitts et Nevis" => "Saint Kitts et Nevis",
				"Saint-Marin" => "Saint-Marin",
				"Saint-Vincent" => "Saint-Vincent",
				"Sainte-Lucie" => "Sainte-Lucie",
				"Samoa Orientale" => "Samoa Orientale",
				"Sao Tomé" => "Sao Tomé",
				"Sénégal" => "Sénégal",
				"Serbie" => "Serbie",
				"Seychelles" => "Seychelles",
				"Sierra Léone" => "Sierra Léone",
				"Singapour" => "Singapour",
				"Slovaquie" => "Slovaquie",
				"Slovénie" => "Slovénie",
				"Somalie" => "Somalie",
				"Soudan" => "Soudan",
				"Sri Lanka" => "Sri Lanka",
				"Suède" => "Suède",
				"Suisse" => "Suisse",
				"Surinam" => "Surinam",
				"Swaziland" => "Swaziland",
				"Syrie" => "Syrie",
				"Tadjikistan" => "Tadjikistan",
				"Taïwan" => "Taïwan",
				"Tanzanie" => "Tanzanie",
				"Tchad" => "Tchad",
				"Thaïlande" => "Thaïlande",
				"Togo" => "Togo",
				"Tonga" => "Tonga",
				"Trinidad et Tobago" => "Trinidad et Tobago",
				"Tunisie" => "Tunisie",
				"Turkménistan" => "Turkménistan",
				"Turks et Caicos" => "Turks et Caicos",
				"Turquie" => "Turquie",
				"Tuvalu" => "Tuvalu",
				"Ukraine" => "Ukraine",
				"Uruguay" => "Uruguay",
				"Vanuatu" => "Vanuatu",
				"Vatican" => "Vatican",
				"Vénézuela" => "Vénézuela",
				"Vietnam" => "Vietnam",
				"Yemen" => "Yemen",
				"Zambie" => "Zambie",
				"Zimbabwé" => "Zimbabwé",
				"Zone Neutre Irak-Arabie Saoud." => "Zone Neutre Irak-Arabie Saoud."
			];
		}
	}
?>