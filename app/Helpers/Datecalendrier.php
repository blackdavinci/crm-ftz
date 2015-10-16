<?php
namespace App\Helpers;

use App\Note; 
use Auth;

class Datecalendrier
{
	var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
	var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	
	public function getAll($year){
		$r = array();
		$date = strtotime($year.'-01-01');
		while(date('Y',$date) <= $year){
			$y = date('Y',$date);
			$m = date('n',$date);
			$d = date('j',$date);
			$w = str_replace('0','7',date('w',$date));
			$r[$y][$m][$d] = $w;
			$date = strtotime(date('Y-m-d',$date).'+1 DAY');		
		}
		return $r;
	}

	public function getNotes($year){

	$notes = Note::where('etat',1)->get();
	return $notes;
	}

	public function getNotesPerso($year){
	 $match = ['etat'=>'1','id_user_destination'=>Auth::user()->id];
	$notes = Note::where($match)->get();
	return $notes;
	}
}