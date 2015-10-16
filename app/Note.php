<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model implements \MaddHatter\LaravelFullcalendar\Event
{

	protected $fillable = array('nom','id_user_destination','id_user_redacteur','categorie','echeance','user_id','contact_id','type','designation','etat');


public function contact(){

		return $this->belongsTo('App\Contact');
	}

public function user(){

        return $this->belongsTo('App\User');
    }

	 protected $dates = ['start', 'end'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->nom;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->created_at;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->created_at;
    }
}
