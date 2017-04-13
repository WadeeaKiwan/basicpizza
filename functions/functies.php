<?PHP

	#punten verwisselen door komma's en een nul erachter plaatsen indien nodig, of ,- achter het getal plakken.
	#vooral handig voor valuta.
	function ShowCash($getal)
	{
		if (substr($getal, -1)!='-')
		{
			if (substr($getal, -2, -1)=='.')
			{
				$getal= str_replace('.', ',', $getal);
				$getal= $getal."0";
			}
			elseif (substr($getal, -3, -2)=='.')
			{
				$getal= str_replace('.', ',', $getal);
			}
			elseif (substr($getal, -2, -1)=='.')
			{
				$getal= str_replace(',', '.', $getal);
			}
			elseif (substr($getal, -3, -2)==',')
			{
				$getal= str_replace(',', '.', $getal);
			}
			elseif ( (!substr_count($getal, ',')) || (!substr_count($getal, '.')) )
			{
				$getal= $getal.",--";
			}
		}

		$getal= "&euro;&nbsp;".$getal;

		return $getal;
	}

	#punten verwisselen door komma's en een nul erachter plaatsen indien nodig, of ,- achter het getal plakken.
	#vooral handig voor valuta.
	function ShowCash2($getal)
	{
		if (substr($getal, -1)!='-')
		{
			if (substr($getal, -2, -1)=='.')
			{
				$getal= str_replace('.', ',', $getal);
				$getal= $getal."0";
			}
			elseif (substr($getal, -3, -2)=='.')
			{
				$getal= str_replace('.', ',', $getal);
			}
			elseif (substr($getal, -2, -1)=='.')
			{
				$getal= str_replace(',', '.', $getal);
			}
			elseif (substr($getal, -3, -2)==',')
			{
				$getal= str_replace(',', '.', $getal);
			}
			elseif ( (!substr_count($getal, ',')) || (!substr_count($getal, '.')) )
			{
				$getal= $getal.",00";
			}
		}

		return $getal;
	}
	
	#Datum notatie omdraaien.
	function SwitchDate($datum)
	{
		$tmp= explode("-", $datum);
		$nwe_datum= $tmp['2']."-".$tmp['1']."-".$tmp['0'];

		return $nwe_datum;
	}
	
	

?>