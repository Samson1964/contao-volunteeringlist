<?php

class VolunteeringlistClass extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_volunteeringlist_default';

	/**
	 * Generate the module
	 */
	protected function compile()
	{
		// Adresse aus Datenbank laden, wenn ID übergeben wurde
		if($this->volunteeringlist)
		{
			// Listentitel laden
			$objListe = $this->Database->prepare("SELECT * FROM tl_volunteeringlist WHERE id=?")
			                           ->execute($this->volunteeringlist);
			// Liste gefunden
			if($objListe)
			{
				// Template zuweisen
				if($this->volunteeringlist_alttemplate) // Alternativ-Template wurde definiert
					$this->Template = new FrontendTemplate($this->volunteeringlist_template);
				else // Kein Alternativ-Template, dann Standard-Template nehmen
					($objListe->templatefile) ? $this->Template = new FrontendTemplate($objListe->templatefile) : $this->Template = new FrontendTemplate($this->strTemplate);
				// Restliche Variablen zuweisen
				$this->Template->id = $this->volunteeringlist;
				$this->Template->vorlage = $objListe->templatefile;
				$this->Template->title = $objListe->title;
				// Listeneinträge laden
				$objItems = $this->Database->prepare("SELECT * FROM tl_volunteeringlist_items WHERE pid=? ORDER BY sorting")
				                           ->execute($this->volunteeringlist);
				if($objItems)
				{
					$i = 0;
					while($objItems->next())
					{
						(bcmod($i,2)) ? $item[$i]['class'] = 'odd' : $item[$i]['class'] = 'even';
						$item[$i]['id'] = $i;
						$item[$i]['name'] = $objItems->name;
						$item[$i]['register_id'] = $objItems->spielerregister_id;
						// Lebensdaten formatieren
						if($objItems->spielerregister_id)
						{
							// Eintrag im Spielerregister vorhanden
							$objRegister = $this->Database->prepare('SELECT * FROM tl_spielerregister WHERE id = ?')
							                    ->execute($objItems->spielerregister_id);
							$item[$i]['birthday'] = $this->getDate($objRegister->birthday);
							$item[$i]['deathday'] = $this->getDate($objRegister->deathday);
						}
						else
						{
							// Daten aus Funktionärsliste übernehmen
							$item[$i]['birthday'] = $this->getDate($objItems->birthday);
							$item[$i]['deathday'] = $this->getDate($objItems->deathday);
						}
						// Lebensdaten übernehmen
						$item[$i]['lifedate'] = '';
						if($item[$i]['birthday']) $item[$i]['lifedate'] .= '* ' . $item[$i]['birthday'] . ' ' . $item[$i]['birthplace'];
						if($item[$i]['birthday'] && $item[$i]['deathday']) $item[$i]['lifedate'] .= ', &dagger; ' . $item[$i]['deathday'] . ' ' . $item[$i]['deathplace'];
						elseif($item[$i]['deathday']) $item[$i]['lifedate'] .= '&dagger; ' . $item[$i]['deathday'] . ' ' . $item[$i]['deathplace'];
						// Amtszeit übernehmen
						$item[$i]['fromDate'] = $this->getDate($objItems->fromDate);
						$item[$i]['toDate'] = $this->getDate($objItems->toDate);
						if($item[$i]['fromDate'] == $item[$i]['toDate']) $item[$i]['fromto'] = $item[$i]['fromDate'];
						else
						{
							if($item[$i]['fromDate'] && $item[$i]['toDate']) $item[$i]['fromto'] = $item[$i]['fromDate'] . ' - ' . $item[$i]['toDate'];
							elseif($item[$i]['fromDate'] && !$item[$i]['toDate']) 
								($i == 0) ? $item[$i]['fromto'] = 'seit ' . $item[$i]['fromDate'] : $item[$i]['fromto'] = 'von ' . $item[$i]['fromDate'];
							elseif(!$item[$i]['fromDate'] && $item[$i]['toDate']) $item[$i]['fromto'] = 'bis ' . $item[$i]['toDate'];
						}
						$item[$i]['info'] = $objItems->info;
						// Bild extrahieren
						if($objItems->singleSRC)
						{
							$objFile = \FilesModel::findByPk($objItems->singleSRC);
							$item[$i]['image'] = $objFile->path;
							$item[$i]['thumbnail'] = Image::get($objFile->path, 70, 70, 'crop');
						}
						else $item[$i]['image'] = '';
						$i++;
					}
					$this->Template->item = $item;
				}
			}
		}
		return;
	}

	/**
	* Datumswert aus Datenbank umwandeln
	* @param mixed
	* @return mixed
	*/
	protected function getDate($varValue)
	{
		$laenge = strlen($varValue);
		$temp = '';
		switch($laenge)
		{
			case 8: // JJJJMMTT
				$temp = substr($varValue,6,2).'.'.substr($varValue,4,2).'.'.substr($varValue,0,4);
				break;
			case 6: // JJJJMM
				$temp = substr($varValue,4,2).'.'.substr($varValue,0,4);
				break;
			case 4: // JJJJ
				$temp = $varValue;
				break;
			default: // anderer Wert
				$temp = '';
		}

		return $temp;
	}

}
?>